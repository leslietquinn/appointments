<?php

	final class QPage_Handler_Alerts extends QPage_Handler_Validator {
		public function __construct() {
			$this -> initialise();
			$this -> id = 'alerts';
		}
		
		public function execute( QDataspace_Interface $dataspace ) { 
			if( $this -> validate( $request = QRegistry::get( 'request' ), QRegistry::get( 'logger' ) ) ) {
				$request -> set( QCommon::FLASH_MESSAGE, $request -> get( 'session' ) -> get( QCommon::FLASH_MESSAGE ) ); 
				$request -> get( 'session' ) -> destroy( QCommon::FLASH_MESSAGE );
				
				$this -> handler -> execute( $dataspace );
			} 
		}
		
		protected function initialise() {
			$this -> forward( new QPage_Handler_Alerts_Alternative() );
			
			$this -> addCondition( new QValidator_Condition_Has_Session( QCommon::FLASH_MESSAGE ) );
		}
	}
	
?>
