<?php

	final class QVisitors_Action_Dispatcher extends QFront_Controller_Action_Dispatcher {

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
		 * Generate a response based on a URI request; display the booking screen
		 *
		 * @access				public
		 * @introduced			2022-01-18
		 * @return				object typeof QPage_Handler_Interface
		 */

		public function bookAppointmentAction() : QPage_Handler_Interface {

			/**
			 * @note 	format a human friendly date for presentation, $booking_date_format, and also for 
			 * 			preservation in the form, $__date__
			 */

			$request = QRegistry::get( 'request' );
			$request -> addFilter( new QFilter_Set_Default( 'booking_date_format', $request -> get( 'id' ) ) );
			$request -> addFilter( new QFilter_Date( 'booking_date_format', QInterval_Date::HUMAN_READABLE ) );
			$request -> addFilter( new QFilter_Set_Default( '__date__', $request -> get( 'id' ) ) );
			$request -> process();

			include_once( dirname( __FILE__ ).'/book-appointment/includes.php' );
			
			return new QPage_Handler_Page();
		}
			
		/**
		 * Generate a response based on a URI request; process booking request
		 *
		 * @access				public
		 * @introduced			2022-01-18
		 * @return				object typeof QPage_Handler_Interface
		 */

		public function processBookingAction() : QPage_Handler_Interface {
			include_once( dirname( __FILE__ ).'/process-booking/includes.php' );
			
			/**
			 * @note 	unable to attach composite for AJAX response as per normal; within a $handler's 
			 * 			constructor (it doesn't attach) so we recurse the tree and attach here instead, 
			 * 			for it to work
			 */

			$handler = new QPage_Handler_Recurse( new QPage_Handler_Cachable( new QPage_Handler_Page() ) );
			$handler -> attach( 
				new QPage_Handler_Cachable( 
					new QPage_Handler_Alerts() 
				), 'page' 
			);
			
			return $handler -> get();
		}
	
	}
	
?>