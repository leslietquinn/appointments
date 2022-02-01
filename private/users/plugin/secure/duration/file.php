<?php

	final class QUsers_Plugin_Secure_Duration extends QFront_Controller_Plugin_Condition {
		protected QUsers_Facade $facade;
		protected string $redirect;
		protected string $hash_key;
		
		/**
		 * Class constructor
		 * 
		 * @param 	$redirect 			string
		 * @param 	$hash_key			string
		 * 
		 * @access			public
		 * @introduced		2022/01/19 [build date]
		 * @return			void
		 */

		public function __construct( string $redirect, string $hash_key = '' ) {
			$this -> redirect = $redirect;
			$this -> hash_key = $hash_key;
		}
		
		/**
		 * Process a step, validate TTL for active users
		 * 
		 * @access			public
		 * @introduced		2022/01/19 [build date]
		 * @return			void
		 */

		public function process() : void {

			/**
			 * @todo	requires to be refactored
			 */
			
			if( $this -> validate( $request = QRegistry::get( 'request' ), QRegistry::get( 'logger' ) ) ) {
				// access to public part of secure area
				return;
			} else {
				$login = QRegistry::get( 'configuration' ) -> get( 'login' );
				$phrase = $request -> get( 'session' ) -> get( $this -> hash_key );
				
				$record = $this -> finder -> passphrase( $request -> get( 'session' ) );
				
				if( !( $record -> get( 'status' ) == 'yes' && $phrase == sha1( $record -> get( 'code' ).$record -> get( 'password' ).$record -> get( 'username' ) ) ) ) {
					// account either not active or authenticated
					header( 'location:'.$request -> get( '__baseuri' ).$this -> redirect );
					exit();
				}
				
				$remainder = time() - $record -> get( 'login' );
				if( $login['duration'] > $remainder ) {
					$record -> acknowledge(); 
					return;
				} 
				
				// activity exceeds allowed duration
				header( 'location:'.$request -> get( '__baseuri' ).$this -> redirect );
				exit();
			}
		}

		/**
		 * Facilitate access to the domain layer
		 *
		 * @param	$facade			object typeof QShops_Clients_Facade
		 *
		 * @access			public
		 * @introduced		2022/01/19 [build date]
		 *
		 * @return			object typeof QUsers_Facade 
		 */
		 
		public function setObject( QUsers_Facade $facade ) : QUsers_Facade {
			$this -> facade = $facade;
		}
	}
	
?>