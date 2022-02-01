<?php

	final class QAjax_Action_Dispatcher extends QFront_Controller_Action_Dispatcher {
		public function __construct() {} /* not implemented */
		
		/**
		 * Default view
		 * 
		 * @access			public
		 * @introduced		2022/01/21
		 * @return			object typeof QPage_Handler_Interface
		 */

		public function showAction() : QPage_Handler_Interface { 
			include_once( dirname( __FILE__ ).'/show/includes.php' );
			
			$factory = new QPage_Handler_Page_Factory();
			return $factory -> get();
		}
		
		/************************************************************************************************/
		/*																								*/
		/*	Appointments 																				*/
		/*																								*/
		/************************************************************************************************/

		/**
		 * Manage the response for open appointment searches
		 * 
		 * @access			public
		 * @introduced		2022/01/21
		 * @return			object typeof QPage_Handler_Interface 
		 */

		public function searchAppointmentsOpenAction() : QPage_Handler_Interface {
			include_once( dirname( __FILE__ ).'/search-appointments-open/includes.php' );
			
			return new QPage_Handler_Page();
		}

		/**
		 * Manage the response for confirmed appointment searches
		 * 
		 * @access			public
		 * @introduced		2022/01/21
		 * @return			object typeof QPage_Handler_Interface 
		 */

		public function searchAppointmentsConfirmedAction() : QPage_Handler_Interface {
			include_once( dirname( __FILE__ ).'/search-appointments-confirmed/includes.php' );
			
			return new QPage_Handler_Page();
		}
		
	}
	
?>