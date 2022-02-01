<?php
	
	final class QUsers_Plugin_Secure_Access implements QFilter_Interface {
		private array $secure_area;
		private string $passphrase;
		private string $redirect;
		
		private QUsers_Facade $facade;
		
		/**
		 * Class constructor
		 *
		 * @param	$secure_area			array
		 * @param	$redirect				strign uri
		 * @param	$passphrase				string S_SESSION token
		 *
		 * @access			public
		 * @introduced		2022/01/19 [build date]
		 *
		 * @return			void
		 */
		 
		public function __construct( array $secure_area, string $redirect, string $passphrase ) {
			$this -> secure_area = $secure_area;
			$this -> passphrase = $passphrase;
			$this -> redirect = $redirect;			
		}
		
		/**
		 * Process an action, to secure client area
		 *
		 * @access			public
		 * @introduced		2022/01/19 [build date]
		 *
		 * @return			void
		 */
		 
		public function process() : void {
			$args = func_get_args();
			$dataspace = array_shift( $args ); 
			
			if( in_array( $dataspace -> get( 'controller' ), $this -> secure_area  ) ) {
				
				/**
				 * @note	send $request to determine the validity of the 
				 *			submitted sign in details, and redirect to the 
				 *			log in screen, via logging out
				 *
				 */
				 
				if( !$this -> facade -> verifyPassphrase() -> push( $dataspace ) ) {
					header( 'location:'.$dataspace -> get( '__alternatebaseuri' ).$this -> redirect );
					exit;
				}
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
		 * @return			void 
		 */
		 
		public function setObject( QUsers_Facade $facade ) : void {
			$this -> facade = $facade;
		}
	}
	
?>