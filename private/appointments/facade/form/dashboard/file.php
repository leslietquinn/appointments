<?php
	
	final class QAppointments_Facade_Form_Dashboard extends QForm_Select_Control implements QAcceptee_Interface {
		protected string $field_name;
		
		/**
		 * Class constructor
		 *
		 * @param	$field_name			string
		 *
		 * @access			public
		 * @introduced		2022-01-19 [build date]
		 * @return			void
		 */
		 
		public function __construct( string $field_name ) {
			$this -> field_name = $field_name;

			/**
			 * @note 	default to column ID in database, for the value to use 
			 * 			as primary key; change accordingly to needs
			 */
			
			parent::__construct( 'id' );
		}
		
		/**
		 * Prepare and return a data set suitable for a form control
		 *
		 * @access			public
		 * @introduced		2022-01-19 [build date]
		 * @return			array
		 * @throws			QPage_Exception
		 */
		 
		protected function toArray() : array {
			$conn = QRegistry::get( 'connection' );
			
			try {
				$rs = $conn -> query( QDao_Statement::bindParams( $conn,
					"select
						tb.id 
					  , tb.name 
				   from appointments tb 
				   
			   order by tb.name asc;",
						array(

						)
					)
				);
			
				$rows = array();
				while( $row = $rs -> getRow() ) {
					$rows[] = new QParameters( $row );
				}
				
				return $rows;
			} catch( QDb_Exception $e ) {
				throw new QPage_Exception( $e -> getMessage() );
			}
		}
		
	}
	
?>