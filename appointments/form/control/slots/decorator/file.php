<?php

	final class QAppointments_Form_Control_Slots_Decorator extends QForm_Select_Control {
		protected QForm_Select_Control $decorated;
		
		/**
		 * Class constructor
		 * 
		 * @param	$field_name 		string
		 * @param 	$decorated			object typeof QForm_Select_Control
		 * 
		 * @access			public
		 * @introduced 		2022-01-16 [build date]
		 * @return 			void
		 */
		 
		public function __construct( string $field_name, QForm_Select_Control $decorated ) {
			$this -> field_name = $field_name;
			$this -> decorated = $decorated;
			parent::__construct( 'id' );
		}
		
		/**
		 * Return data suitable for form control, an array of hourly slots after alteration
		 * 
		 * @access			public
		 * @introduced 		2022-01-18
		 * @return 			array
		 */

		public function toArray() : array {
			$slots = $this -> decorated -> toArray();
			$in_use = $this -> queryDb( $this -> getDate( 'date' ) );

			foreach( $slots as $slot ) {
				if( in_array( $slot -> get( 'id' ), $in_use ) ) {
					$slot -> set( 'ignore', 'yes' );
				}
			}
			
			return $slots;
		}

		/**
		 * Facilitate access to the request; return a parameter
		 * 
		 * @access			protected
		 * @introduced		2022/01/18
		 * @return			string
		 */

		protected function getDate() : string {
			return QRegistry::get( 'request' ) -> get( '__date__' );
		}


		/**
		 * Prepare SQL to query database for a number of records
		 *
		 * @param	$data 			string
		 *
		 * @access			protected
		 * @introduced		2022/01/18
		 *
		 * @return			array
		 * @throws 			QDb_Exception
		 */
		 
		protected function queryDb( string $date ) : array { 
			$conn = QRegistry::get( 'connection' );

			try {
				$rs = $conn -> query( 
					QDao_Statement::bindParams( $conn, 
						"select
							ap.slot 
					   from appointments ap 
					  where ap.session = ?
					    and ap.open = 'yes'", 
						array(
							1	=>	$date
						) 
					)
				); 
				
				$rows = array();
				while( $row = $rs -> getRow() ) {
					$rows[] = $row['slot'];
				}
				
				return $rows;
			} catch( QDb_Exception $e ) {
				throw new QDb_Exception( $e -> getMessage() );
			}
		}
		
	}
	
?>