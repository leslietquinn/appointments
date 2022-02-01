<?php
	
	final class QPage_Handler_Alerts_Alternative extends QPage_Handler {
		public function __construct() {
			$this -> id = 'alerts';
		}
		
		public function execute( QDataspace_Interface $dataspace ) { 
			$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) ); 
			$page -> render( $request -> get( QCommon::FLASH_MESSAGE ) );
		}
	}
	
?>