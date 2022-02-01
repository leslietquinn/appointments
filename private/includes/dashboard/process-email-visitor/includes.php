<?php
	
	final class QPage_Handler_Page extends QPage_Handler_Validator {
		
		/**
		 * Class constructor
		 *
		 * @access			public
		 * @introduced		2022/01/22
		 *
		 * @return			void
		 */
		 
		public function __construct() {
			$this -> id = 'page';
			$this -> initialise();
		}
		
		/**
		 * Execute this $handler to produce a HTML composite, part of a response
		 *
		 * @param	$dataspace			object typeof QDataspace_Interface
		 *
		 * @access			public
		 * @introduced		2022/01/22
		 *
		 * @return			void
		 * @throws 			QFront_Controller_Exception
		 */
		 
		public function execute( QDataspace_Interface $dataspace ) {
			$request = QRegistry::get( 'request' );
			if( $request -> has( QForm::ID ) ) {
				$request -> addFilter( new QFilter_Set_Default( 'id', $request -> get( QForm::ID ) ) );
				$request -> process();
			}

			if( !$this -> validate( $request = QRegistry::get( 'request' ), QRegistry::get( 'logger' ) ) ) {
				$this -> handler -> execute( $dataspace );
			} else { 
				$request -> addFilter( new QHttp_Request_Security_Hash_Reset( QForm::TOKEN ) );
				$request -> addFilter( new QFilter_Set_Default( 'processor', 'send-visitor-email' ) );
				$request -> process();

				$flag = true;
				try {
					$message = 'dashboard/commit.tpl';
					$facade = new QAppointments_Facade();
					if( !$facade -> email() -> push( $request ) ) {
						$message = 'dashboard/rollback.tpl';
						$flag = false;
					} 
				} catch( QPage_Exception $e ) { 
					throw new QFront_Controller_Exception( $e -> getMessage() );
				}
				
				/**
				 * @note 	on success, there is a redirect back to ./dashboard from the client; 
				 * 			the success.tpl template simply contains "__REDIRECT__" to permit the
				 * 			redirect otherwise output a response
				 */

				$template = 'dashboard/success.tpl';
				$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) );
				$request -> get( 'session' ) -> set( QCommon::FLASH_MESSAGE, $message );

				if( !$flag ) {
					$template = 'dashboard/process-email-visitor/failure.tpl';
				}
				
				$page -> render( $template );
			}
		}
		
		/**
		 * Initialise, determine the next $handler based on one or more conditions
		 *
		 * @access			protected
		 * @introduced		2022/01/22
		 *
		 * @return			void
		 */
		 
		protected function initialise() {
			$this -> forward( new QPage_Handler_Page_Failure() );
			
			$this -> addCondition( new QValidator_Condition_Http_Post() );
			$this -> addCondition( QValidator_Factory::formToken( QForm::TOKEN, QCommon::PK_STANDARD ) );
			$this -> addCondition( QValidator_Factory::id( QForm::ID, QCommon::PK_BIG ) );
			$this -> addCondition( QValidator_Factory::textarea( 'body', QDb::SMALL_TEXTAREA ) );
			$this -> addCondition( QValidator_Factory::unicode( 'subject', 768 ) );
		}
	}
	
	final class QPage_Handler_Page_Failure extends QPage_Handler {
		public function __construct() {
			$this -> id = 'page';
		}
		
		public function execute( QDataspace_Interface $dataspace ) {
			$request = QRegistry::get( 'request' );
			$request -> get( 'session' ) -> set( QCommon::FLASH_MESSAGE, 'dashboard/rollback.tpl' );
			
			$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) );
			$page -> set( 'logger', $logger = QRegistry::get( 'logger' ) ); 
			
			$page -> render( 'dashboard/process-email-visitor/error.tpl' ); 
		}
	}
	
?>