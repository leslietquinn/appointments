<?php
	
	final class QAppointments_Facade_Load extends QDao implements QAcceptee_Interface {
		protected string $field_name;
		
		/**
		 * Class constructor
		 *
		 * @param	$field_name			string
		 *
		 * @access			public
		 * @introduced		2022-01-19 [build date]
		 *
		 * @return			void
		 */
		 
		public function __construct( string $field_name ) {
			$this -> field_name = $field_name;
		}
		
		/**
		 * Perform an operation and pass it onto $acceptable
		 *
		 * @param	$acceptable			object typeof QDataspace_Interface
		 *
		 * @see					QAppointments_Facade::load();
		 *
		 * @access				public
		 * @introduced			2022-01-19 [build date]
		 *
		 * @return				void
		 * @throws				QPage_Exception
		 */
		 
		public function push( $acceptable ) : void {
			if( !( $acceptable instanceof QDataspace_Interface or $acceptable instanceof QPage_Interface ) ) {
				throw new QPage_Exception( 'thrown exception: unsupported interface [app/appointments/facade/load] 37' );
			}
			
			$record = new QAppointments_Record( $acceptable -> get( 'id' ) );
			
			if( !$record -> has( 'id' ) ) {
				throw new QPage_Exception( 'thrown exception: invalid primary key given [app/appointments/facade/load] 43' );
			}
			
			$acceptable -> import( new QParameters( array( $this -> field_name => $this -> runFilters( $record ) ) ) );
		}
		
		/**
		 * Process one or more filters on the data supplied
		 *
		 * @param	$dataspace			object typeof QDataspace_Interface
		 *
		 * @access				protected
		 * @introduced			2022-01-19
		 *
		 * @return				object typeof QDataspace_Interface
		 */
		 
		protected function runFilters( QDataspace_Interface $dataspace ) : QDataspace_Interface {
			$dataspace -> addFilter( new QAppointments_Filter_Slots( 'slot', 'alternate_slot' ) );
			$dataspace -> process();

			return $dataspace;
		}
		
	}
	
?>