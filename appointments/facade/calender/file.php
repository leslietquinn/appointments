<?php
	
	final class QAppointments_Facade_Calender extends QDao implements QAcceptee_Interface {
		protected string $field_name;
		protected int $adjustment;

		/**
		 * Class constructor
		 *
		 * @param	$field_name 		string
		 * @param	$adjustment			int
		 *
		 * @access			public
		 * @introduced		2022-01-16 [build date]
		 *
		 * @return			void
		 */
		 
		public function __construct( string $field_name, int $adjustment ) {
			$this -> field_name = $field_name;
			$this -> adjustment = $adjustment;
		}
		
		/**
		 * Perform an operation and pass it onto $acceptable
		 *
		 * @param	$acceptable			object typeof QDataspace_Interface
		 *
		 * @see					QAppointments_Facade::calender();
		 *
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 *
		 * @return				void
		 * @throws				QPage_Exception
		 */
		 
		public function push( $acceptable ) : void {
			if( !( $acceptable instanceof QDataspace_Interface or $acceptable instanceof QPage_Interface ) ) {
				throw new QPage_Exception( 'thrown exception: unsupported interface [app/appointments/facade/calender] 40' );
			}
			
			try {
				$appointment = new QAppointments();
				$month = $appointment -> adjustToMonth( date( 'm' ) + $this -> adjustment );

				$acceptable -> import( 
					new QParameters(
						array(
							$this -> field_name => QInterval::month( $appointment -> adjustToMonth( $month ), 'full' )
						)
					)
				); 
			} catch( QAppointments_Exception $e ) {
				throw new QPage_Exception( $e -> getMessage() );
			}
		}
		
	}
	
?>