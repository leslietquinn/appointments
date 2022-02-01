<?php

	final class QHome_Action_Dispatcher extends QFront_Controller_Action_Dispatcher {
		public function __construct() {} /* not implemented */
		
		public function showAction() {
			$request = QRegistry::get( 'request' );
			
			if( $request -> get( 'session' ) -> has( QUsers::PASSPHRASE ) ) { 
				
				/**
				 * @note	validitify existing passphrase in use, and 
				 *			redirect to the dashboard if good, there is no 
				 *			need to sign in
				 *
				 */
				 
				$facade = new QUsers_Facade();
				if( $facade -> verifyPassphrase() -> push( $request ) ) {
					header( 'location:'.$request -> get( '__alternatebaseuri' ).'dashboard/' );
					exit;
				}
			} 
			
			/**
			 * @note	default by showing the sign in screen, because no 
			 *			$_SESSION found containing a passphrase
			 *
			 */
			 
			include_once( dirname( __FILE__ ).'/show/includes.php' );
			
			$factory = new QPage_Handler_Page_Factory();
			
			return $factory -> get();
		}
		
	}
	
?>