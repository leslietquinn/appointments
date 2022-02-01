<?php

	final class QPage_Handler_Head extends QPage_Handler {

		/**
		 * Class constructor
		 * 
		 * @access				public
		 * @introduced			2022-01-17
		 * @return				void
		 */

		public function __construct() {
			$this -> id = 'head';
		}
		
		/**
		 * Execute a process to generate a response
		 * 
		 * @param	$dataspace 			object typeof QDataspace_Interface 
		 * 
		 * @access				public
		 * @introduced			2022-01-17
		 * @return				void
		 */

		public function execute( QDataspace_Interface $dataspace ) : void {
			$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) );
			$page -> render( 'appointments/booking-complete/head.tpl' );
		}
	}
	
	final class QPage_Handler_Body extends QPage_Handler {

		/**
		 * Class constructor
		 * 
		 * @access				public
		 * @introduced			2022-01-17
		 * @return				void
		 */
		
		public function __construct() {
			$this -> id = 'body'; 
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
			$page -> operate( $facade -> load( 'appointment' ) );

			$page -> render( 'appointments/booking-complete/body.tpl' );
		}
	}

?>