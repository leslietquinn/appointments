<?php
	
	final class QPage_Handler_Alerts_Alternative extends QPage_Handler {

		/**
		 * CLass constructor
		 * 
		 * @access			public
		 * @introduced		2022/01/17
		 * @return			void
		 */

		public function __construct() {
			$this -> id = 'alerts';
		}
		
		/**
		 * Generate a response based on the given request and underlying model
		 * 
		 * @param	$dataspace 			object typeof QDataspace_Interface
		 * 
		 * @access			public
		 * @introduced		2022/01/17
		 * @return			void
		 */

		public function execute( QDataspace_Interface $dataspace ) : void { 
			$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) ); 
			$page -> render( $request -> get( QCommon::FLASH_MESSAGE ) );
		}
	}
	
?>