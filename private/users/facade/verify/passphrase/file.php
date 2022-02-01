<?php
	
	final class QUsers_Facade_Verify_Passphrase extends QDao implements QAcceptee_Interface {
		
		/**
		 * Class constructor
		 *
		 * @access			public
		 * @introduced		2022/01/19 [build date]
		 *
		 * @return			void
		 */
		 
		public function __construct() {}
		
		/**
		 * Perform an operation and pass it onto $acceptable
		 *
		 * @param	$acceptable			object typeof QDataspace_Interface
		 *
		 * @access			public
		 * @introduced		2022/01/19 [build date]
		 *
		 * @see				QUsers_Facade::verifyPassphrase();
		 * @see				QUsers_Plugin_Secure_Access::process();
		 * @see				QHome_Action_Dispatcher::show();
		 *
		 * @return			bool
		 * @throws			QFront_Controller_Exception
		 */
		 
		public function push( $acceptable ) : bool {
			if( !( $acceptable instanceof QDataspace_Interface ) ) {
				throw new QFront_Controller_Exception( 'thrown exception: expected QDataspace_Interface [private/users/facade/verify/passphrase] 34' );
			}
			
			/**
			 * @note	arrive here, from ./private/users/plugin/secure/access/
			 *			and verify the existing passphrase is true and valid and if not, 
			 *			log out on false
			 *
			 */
			
			try {
				$user = $this -> queryDb( $passphrase = $acceptable -> get( 'session' ) -> get( QUsers::PASSPHRASE ) );
			} catch( QDb_Exception $e ) {
				throw new QFront_Controller_Exception( $e -> getMessage() );
			}
			
			if( ( $user -> has( 'id' ) and sha1( $user -> get( 'code' ).$user -> get( 'password' ).$user -> get( 'email' ) ) == $passphrase ) ) {
				
				/**
				 * @note	a match has been found for credientials belonging 
				 *			to a passphrase, so return true, otherwise false
				 *
				 */
				 
				return true;
			} 
			
			return false;
		}
		
		/**
		 * Prepare SQL to query database for a passphrase
		 *
		 * @param	$passphrase				string
		 *
		 * @access			protected
		 * @introduced		2022/01/19 [build date]
		 *
		 * @return			object typeof QDataspace_Interface
		 */
		 
		protected function queryDb( string $passphrase ) : QDataspace_Interface { 
			$rs = $this -> fetch( $sql = 
				QDao_Statement::bindParams( $this -> getConnection(), 
					"select
						us.* 
				   from users us  
			      where us.passphrase = ? 
				    and us.active = 'yes'", 
					array(
						1 =>	$passphrase
					) 
				)
			); 
			
			return new QParameters( $rs -> getRow() );
		}
		
	}
	
?>