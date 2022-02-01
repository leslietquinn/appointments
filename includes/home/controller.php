<?php

	final class QHome_Action_Dispatcher extends QFront_Controller_Action_Dispatcher {
		
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
	
	}
	
?>