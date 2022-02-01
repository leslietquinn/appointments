<?php

	final class QAppointments_Action_Dispatcher extends QFront_Controller_Action_Dispatcher {

		/**
		 * Class constructor
		 * 
		 * @access			public
		 * @introduced		2022-01-17
		 * @return			void
		 */
		
		public function __construct() {} 
				
		/**
		 * Generate a response based on a URI request
		 *
		 * @access				public
		 * @introduced			2022-01-17
		 * @return				object typeof QPage_Handler_Interface
		 */

		public function showAction() : QPage_Handler_Interface {
			include_once( dirname( __FILE__ ).'/show/includes.php' );
			
			$handler = new QPage_Handler_Page_Factory();
			return $handler -> get();
		}
				
		/**
		 * Generate a response based on a URI request
		 *
		 * @access				public
		 * @introduced			2022-01-18
		 * @return				object typeof QPage_Handler_Interface
		 * @throws			QFront_Controller_Exception
		 */

		public function bookingCompleteAction() : QPage_Handler_Interface {
			$request = QRegistry::get( 'request' );
			$request -> set( 'id', $request -> get( 'session' ) -> get( QCommon::TMP ) );

			if( !$request -> has( 'id' ) ) {
				throw new QFront_Controller_Exception( 'thrown exception: missing primary key [app/appointments/controller.php] 44' );
			}

			include_once( dirname( __FILE__ ).'/booking-complete/includes.php' );
			
			$handler = new QPage_Handler_Page_Factory();
			return $handler -> get();
		}
				
		/**
		 * Generate a response based on a URI request
		 *
		 * @access				public
		 * @introduced			2022-01-18
		 * @return				void
		 */

		public function rescheduleAction() : void {
			$request = QRegistry::get( 'request' );
			$request -> get( 'session' ) -> set( '__rescheduled__', $request -> get( 'id' ) );

			header( 'location:'.$request -> get( '__baseuri' ), true, 301 );
			exit();
		}
	}
	
?>