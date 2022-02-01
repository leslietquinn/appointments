<?php

	final class QDashboard_Action_Dispatcher extends QFront_Controller_Action_Dispatcher {
		public function __construct() {} /* not implemented */

		/********************************************************************************************************************/
		/*																													*/
		/*	Appointments																									*/
		/*																													*/
		/********************************************************************************************************************/
		
		/**
		 * Change the status of a record, from unconfirmed to confirmed, and change open status
		 * 
		 * @access			public
		 * @introduced		2022/01/22
		 * @return			void
		 */

		public function confirmAppointmentAction() : void {
			$request = QRegistry::get( 'request' ); 
			
			$message = 'dashboard/commit.tpl';
			$facade = new QAppointments_Facade();

			/**
			 * @note 	make use of the Visitor pattern for domain layer separation
			 */

			try {
				if( !$facade -> change() -> push( $request ) ) {
					$message = 'dashboard/rollback.tpl';
				} else { 

					/**
					 * @note 	a successful commit on the database; an appointment has been set to 
					 * 			confirmed, now schedule an automated email to visitor; rather than depend 
					 * 			on a manual confirmation email (not) being sent
					 */

					header( 'location:'.$request -> get( '__alternatebaseuri' ).'dashboard/automate-email-visitor/'.$request -> get( 'id' ).'/' );
					exit();
				}
			} catch( QPage_Exception $e ) {
				throw new QFront_Controller_Exception( $e -> getMessage() );
			}

			/**
			 * @note 	no commit to database, so back to the dashboard and display message
			 * 			about rollback
			 */

			$request -> get( 'session' ) -> set( QCommon::FLASH_MESSAGE, $message );
			header( 'location:'.$request -> get( '__alternatebaseuri' ).'dashboard/' );
			exit;
		}

		/********************************************************************************************************************/
		/*																													*/
		/*	Visitors																										*/
		/*																													*/
		/********************************************************************************************************************/

		/**
		 * Default, generate a response based on request and model
		 * 
		 * @access			public
		 * @introduced		2022/01/16 [build date]
		 * @return			object typeof QPage_Handler_Interface
		 * @throws			QFront_Controller_Exception
		 */

		public function emailVisitorAction() : QPage_Handler_Interface { 
			$request = QRegistry::get( 'request' );

			$record = new QAppointments_Record( $request -> get( 'id' ) );
			if( !$record -> has( 'id' ) ) {
				throw new QFront_Controller_Exception( 'thrown exception: issue with primary key [app/dashboard/] 59' );
			}

			include_once( dirname( __FILE__ ).'/email-visitor/includes.php' );
			
			$factory = new QPage_Handler_Page_Factory();
			return $factory -> get();
		}

		/**
		 * Default, generate a response based on an AJAX call
		 * 
		 * @access			public
		 * @introduced		2022/01/16 [last modified]
		 * @return			object typeof QPage_Handler_Interface
		 * @throws			QFront_Controller_Exception
		 */

		public function processEmailVisitorAction() : QPage_Handler_Interface { 
			include_once( dirname( __FILE__ ).'/process-email-visitor/includes.php' );
			
			$handler = new QPage_Handler_Recurse( new QPage_Handler_Cachable( new QPage_Handler_Page() ) );
			$handler -> attach( new QPage_Handler_Cachable( new QPage_Handler_Alerts() ), 'page' );
			
			return new QPage_Handler_Page;
		}

		/**
		 * No response, redirect 
		 * 
		 * @access			public
		 * @introduced		2022/01/22 [last modified]
		 * @return			void
		 * @throws			QFront_Controller_Exception
		 */

		public function automateEmailVisitorAction() : void { 
			$request = QRegistry::get( 'request' );

			$record = new QAppointments_Record( $request -> get( 'id' ) );
			if( !$record -> has( 'id' ) ) {
				throw new QFront_Controller_Exception( 'thrown exception: issue with primary key [app/dashboard/] 116' );
			}

			try {
				$message = 'dashboard/commit.tpl';
				$facade = new QAppointments_Facade();

				/**
				 * @note 	we will Decorate the Domain Access Object, which will allow us to "pre-fill" the $request 
				 * 			(alias $acceptable) with a subject line and message, and processor; leaving the intended 
				 * 			DAO to serve dual purposes unhindered
				 */

				if( !$facade -> automatedEmail() -> push( $request ) ) {
					$message = 'dashboard/rollback.tpl';
				} 
			} catch( QPage_Exception $e ) {
				throw new QFront_Controller_Exception( $e -> getMessage() );
			}

			$request -> get( 'session' ) -> set( QCommon::FLASH_MESSAGE, $message );
			header( 'location:'.$request -> get( '__alternatebaseuri' ).'dashboard/' );
			exit;
		}

		/********************************************************************************************************************/
		/*																													*/
		/*	End 																											*/
		/*																													*/
		/********************************************************************************************************************/
		
		/**
		 * Default, generate a response based on request and model
		 * 
		 * @access			public
		 * @introduced		2022/01/16 [build date]
		 * @return			object typeof QPage_Handler_Interface
		 */

		public function showAction() : QPage_Handler_Interface { 
			include_once( dirname( __FILE__ ).'/show/includes.php' );
			
			$factory = new QPage_Handler_Page_Factory();
			return $factory -> get();
		}
		
		/**
		 * @note 	Process an action selected from a dashboard, such as operate on a new peice 
		 * 			of data
		 */

		public function processOptionsAction() {
			$request = QRegistry::get( 'request' ); 
			
			$options = array(); 
			if( !( array_key_exists( $request -> get( 'options' ), $options ) ) ) {
				throw new QFront_Controller_Exception( 'QDashboard::Process_Options() 404 Page Not Found' );
			} 
			
			header( 'location:'.$request -> get( '__alternatebaseuri' ).'dashboard/'.$options[$request -> get( 'options' )].'/' );
			exit();
		}
		
		/**
		 * @note 	Process an action selected from a dashboard, such as operate on an existing peice 
		 * 			of data
		 */

		public function processDashboardAction() {
			$request = QRegistry::get( 'request' );
			
			$options = array(
				'confirmappointment'				=>	'confirm-appointment'
			  , 'emailvisitor'						=>	'email-visitor'

			);
			
			if( !( array_key_exists( $request -> get( 'options' ), $options ) ) ) {

				/**
				 * @note 	throw an exception as missing a part of the route
				 */
				
				throw new QFront_Controller_Exception( 'QDashboard::Process_Dashboard() 404 Page Not Found' );
			} 
			
			if( !( $request -> has( 'dashboard' ) ) ) {

				/**
				 * @note 	throw an exception as missing a primary key
				 */

				throw new QFront_Controller_Exception( 'QDashboard::Process_Dashboard() 404 Page Not Found' );
			} 
			
			header( 'location:'.$request -> get( '__alternatebaseuri' ).'dashboard/'.$options[$request -> get( 'options' )].'/'.$request -> get( 'dashboard' ).'/' );
			exit();
		}
				
	}
	
?>