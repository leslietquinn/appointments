<?php

	final class QPage_Handler_Page extends QPage_Handler {

		/**
		 * Class constructor
		 * 
		 * @access				public
		 * @introduced			2022-01-18
		 * @return				void
		 */

		public function __construct() {
			$this -> id = 'page';
		}
		
		/**
		 * Execute a process to generate a response
		 * 
		 * @param	$dataspace 			object typeof QDataspace_Interface 
		 * 
		 * @access				public
		 * @introduced			2022-01-18
		 * @return				void
		 */

		public function execute( QDataspace_Interface $dataspace ) : void {
			$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) );

			$facade = new QAppointments_Facade();
			$page -> operate( $facade -> formControlSlots( 'slot' ) );

			$page -> render( 'visitors/book-appointment/template.tpl' );
		}
	}
	
?>