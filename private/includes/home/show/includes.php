<?php
	
	final class QPage_Handler_Navigation extends QPage_Handler {
		public function __construct() {
			$this -> id = 'navigation';
		}
		
		/**
		 * @note	replaces default handler
		 *
		 */
		 		
		public function execute( QDataspace_Interface $dataspace ) {
			$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) );
			$page -> render( 'home/navigation.tpl' );
		}
		
		public function isCachable() {
			return QCache::NO_CACHE;
		}
	}
	
	final class QPage_Handler_Head extends QPage_Handler {
		public function __construct() {
			$this -> id = 'head';
		}
		
		public function execute( QDataspace_Interface $dataspace ) {
			$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) );
			$page -> render( 'home/head.tpl' );
		}
	}
	
	final class QPage_Handler_Body extends QPage_Handler_Validator {
		public function __construct() {
			$this -> id = 'body';
			$this -> initialise();
		}
		
		public function execute( QDataspace_Interface $dataspace ) { 
			if( $this -> validate( $request = QRegistry::get( 'request' ), QRegistry::get( 'logger' ) ) ) {
				
				/**
				 * @note	all criteria has been met, all validators processed so 
				 *			move forward otherwise, display the form once more
				 *
				 */
				 
				$this -> handler -> execute( $dataspace );
			} else { 
				$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) );
				$page -> set( 'logger', QRegistry::get( 'logger' ) );
				$page -> render( 'home/body.tpl' );
			}
		}
		
		protected function initialise() {
			$this -> forward( new QPage_Handler_Body_Success() );
			
			$this -> addCondition( new QValidator_Condition_Http_Post() );
			$this -> addCondition( QValidator_Factory::formToken( QForm::TOKEN, QCommon::PK_STANDARD ) );
			$this -> addCondition( QValidator_Factory::emailAddress( 'email', 64 ) );
			$this -> addCondition( QValidator_Factory::password( 'password', QCommon::PK_BIG ) );

		}
	}
	
	final class QPage_Handler_Body_Success extends QPage_Handler {
		public function __construct() { 
			$this -> id = 'body';
		}
		
		public function execute( QDataspace_Interface $dataspace ) {
			$request = QRegistry::get( 'request' );
			$request -> addFilter( new QHttp_Request_Security_Hash_Reset( QForm::TOKEN ) );
			$request -> addFilter( new QFilter_String_Lowercase( 'email' ) );
			$request -> addFilter( new QFilter_Sanitise_Email( 'email' ) );
			$request -> process();

			$request -> addFilter( new QFilter_Hash_Md5( 'password' ) );
			$request -> process();
			
			$facade = new QUsers_Facade();
			if( !$facade -> validateCredentials( $request -> get( '__alternatebaseuri' ).'dashboard/' ) -> push( $request ) ) {
				
				/**
				 * @note	failed to validate credentials so back to the login screen, after 
				 *			logging out (destroying the $_SESSION)
				 *
				 */
				 
				header( 'location:'.$request -> get( '__alternatebaseuri' ).'logout/' );
				exit;
			}
		}
	}
	
?>

