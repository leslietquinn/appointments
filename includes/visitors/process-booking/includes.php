<?php
	
	final class QPage_Handler_Page extends QPage_Handler_Validator {
		
		/**
		 * Class constructor
		 *
		 * @access			public
		 * @introduced			2022-01-18
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
		 * @introduced			2022-01-18
		 *
		 * @return			void
		 */
		 
		public function execute( QDataspace_Interface $dataspace ) : void {
			$request = QRegistry::get( 'request' );
			$request -> addFilter( new QFilter_Set_Default( 'id', $request -> get( QForm::ID ) ) );
			$request -> addFilter( new QFilter_Set_Default( 'booking_date_format', $request -> get( '__date__' ) ) );
			$request -> addFilter( new QFilter_Date( 'booking_date_format', QInterval_Date::HUMAN_READABLE ) );
			$request -> process();
			
			if( !$this -> validate( $request = QRegistry::get( 'request' ), QRegistry::get( 'logger' ) ) ) {
				$this -> handler -> execute( $dataspace );
			} else { 
				$request -> addFilter( new QHttp_Request_Security_Hash_Reset( QForm::TOKEN ) );
				$request -> process();

				$flag = true;
				try {
					$message = 'dashboard/commit.tpl';
					$facade = new QAppointments_Facade();
					if( !$facade -> booking() -> push( $request ) ) {
						$message = 'dashboard/rollback.tpl';
						$flag = false;
					} 
				} catch( QPage_Exception $e ) { 
					throw new QFront_Controller_Exception( $e -> getMessage() );
				}
				
				$template = 'success.tpl';
				$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) );
				$request -> get( 'session' ) -> set( QCommon::FLASH_MESSAGE, $message );

				if( !$flag ) {
					$template = 'visitors/process-booking/failure.tpl';

					$facade = new QAppointments_Facade();
					$page -> operate( $facade -> formControlSlots( 'slot' ) );
				}
				
				$page -> render( $template );
			}
		}
		
		/**
		 * Initialise, determine the next $handler based on one or more conditions
		 *
		 * @access			protected
		 * @introduced			2022-01-18
		 *
		 * @return			void
		 */
		 
		protected function initialise() : void {
			$this -> forward( new QPage_Handler_Page_Failure() );
			
			$this -> addCondition( new QValidator_Condition_Http_Post() );
			$this -> addCondition( QValidator_Factory::formToken( QForm::TOKEN, QCommon::PK_STANDARD ) );
			$this -> addCondition( QValidator_Factory::date( '__date__' ) );
			$this -> addCondition( QValidator_Factory::numeric( 'slot', 2 ) );
			$this -> addCondition( QValidator_Factory::alphaWithSpaces( 'fullname', 128 ) );
			$this -> addCondition( QValidator_Factory::telephone( 'telephone' ) );
			$this -> addCondition( QValidator_Factory::emailAddress( 'email', 64 ) );
		}
	}
	
	final class QPage_Handler_Page_Failure extends QPage_Handler {
		public function __construct() {
			$this -> id = 'page';
		}
		
		public function execute( QDataspace_Interface $dataspace ) : void {
			$request = QRegistry::get( 'request' );
			$request -> get( 'session' ) -> set( QCommon::FLASH_MESSAGE, 'rollback.tpl' );
			
			$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) );
			$page -> set( 'logger', $logger = QRegistry::get( 'logger' ) ); 
			
			$facade = new QAppointments_Facade();
			$page -> operate( $facade -> formControlSlots( 'slot' ) );

			$page -> render( 'visitors/process-booking/error.tpl' ); 
		}
	}
	
?>