<?php

	final class QPage_Handler_Alerts extends QPage_Handler_Validator {
		public function __construct() {
			$this -> initialise();
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
			if( $this -> validate( $request = QRegistry::get( 'request' ), QRegistry::get( 'logger' ) ) ) {
				$request -> set( QCommon::FLASH_MESSAGE, $request -> get( 'session' ) -> get( QCommon::FLASH_MESSAGE ) ); 
				$request -> get( 'session' ) -> destroy( QCommon::FLASH_MESSAGE );
				
				$this -> handler -> execute( $dataspace );
			} 
		}
		
		/**
		 * Initialise and validate one or more conditions, delegate decision making
		 * 
		 * @access			public
		 * @introduced		2022/01/17
		 * @return			void
		 */

		protected function initialise() : void {
			$this -> forward( new QPage_Handler_Alerts_Alternative() );
			$this -> addCondition( new QValidator_Condition_Has_Session( QCommon::FLASH_MESSAGE ) );
		}
	}
	
?>
