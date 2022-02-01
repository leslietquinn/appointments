<?php
	
	final class QUsers_Facade_Validate_Credentials extends QDao implements QAcceptee_Interface {
		protected string $redirect;
		
		/**
		 * Class constructor
		 *
		 * @param	$redirect			string
		 *
		 * @access			public
		 * @introduced		2022/01/19 [build date]
		 *
		 * @return			void
		 */
		 
		public function __construct( string $redirect ) {
			$this -> redirect = $redirect;
		}
		
		/**
		 * Perform an operation and pass it onto $acceptable
		 *
		 * @param	$acceptable			object typeof QDataspace_Interface
		 *
		 * @access			public
		 * @introduced		2022/01/19 [build date]
		 *
		 * @see				QUsers_Facade::validateCredentials();
		 * @see				QHome_Action_Dispatcher::show();
		 *
		 * @return			void
		 *
		 * @note	typically would throw a QPage_Exception however when there 
		 *			is no response, we throw a QFront_Controller_Exception instead
		 *
		 * @throws			QFront_Controller_Exception
		 */
		 
		public function push( $acceptable ) : void {
			if( !( $acceptable instanceof QDataspace_Interface ) ) { 
				throw new QFront_Controller_Exception( 'thrown exception: expected QDataspace_Interface [private/users/facade/validate/credientials] 42' );
			}
			
			/**
			 * @note	arrive here, from ./private/includes/home/show/ 
			 *			to validate email and MD5 hashed password, against a 
			 *			passphrase, if any
			 *
			 */
			 
			try {
				$user = $this -> queryDb( $acceptable -> get( 'email' ) ); 
			} catch( QDb_Exception $e ) { 
				throw new QFront_Controller_Exception( $e -> getMessage() );
			}
			
			if( $user -> has( 'id' ) and $user -> get( 'password' ) == $acceptable -> get( 'password' ) ) {
				if( sha1( $user -> get( 'code' ).$user -> get( 'password' ).$user -> get( 'email' ) ) == $user -> get( 'passphrase' ) ) {
					
					/**
					 * @note	no mistake about it, identity has been proven, so 
					 *			continue, set the $_SESSION and redirect
					 *
					 */
					 
					$acceptable -> get( 'session' ) -> set( QUsers::PASSPHRASE, $user -> get( 'passphrase' ) );
					
					header( 'location:'.$this -> redirect );
					exit;
				} 
			}
			
			/**
			 * @note	if validation fails, then throw an exception to 
			 *			result in a 404 Page not Found, do not show the log in 
			 *			screen immediately
			 *
			 */
			 
			throw new QFront_Controller_Exception( 'thrown exception: invalid credentials submitted [private/users/facade/validate/credentials] 81' );
		}
		
		/**
		 * Prepare SQL to query database for login credentials
		 *
		 * @param	$email				string
		 *
		 * @access			protected
		 * @introduced		2022/01/19 [build date]
		 *
		 * @return			object typeof QDataspace_Interface
		 */
		 
		protected function queryDb( string $email ) : QDataspace_Interface { 
			$rs = $this -> fetch( $sql = 
				QDao_Statement::bindParams( $this -> getConnection(), 
					"select
						us.* 
				   from users us  
			      where us.email = ? 
				    and us.active = 'yes'", 
					array(
						1 =>	$email
					) 
				)
			); 
			
			return new QParameters( $rs -> getRow() );
		}
	}
	
?>