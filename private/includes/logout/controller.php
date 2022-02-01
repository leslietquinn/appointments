<?php

	final class QLogout_Action_Dispatcher extends QFront_Controller_Action_Dispatcher {
		public function __construct() {} /* not implemented */
				
		public function showAction() {
			$request = QRegistry::get( 'request' );
			$request -> get( 'session' ) -> destroy();
			
			session_start();
			
			header( 'location:'.$request -> get( '__alternatebaseuri' ) );
			exit;
		}
		
	}
	
?>