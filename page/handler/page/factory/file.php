<?php

	final class QPage_Handler_Page_Factory extends QPage_Handler_Factory {

		/**
		 * Class constructor
		 * 
		 * @access			public
		 * @introduced		2022/01/17
		 * @return			void
		 */
		
		public function __construct() {
			parent::__construct( 
				array( 
					'head'
				  , 'body'
				) 
			); 
		}
		
		/**
		 * Create a composite structure, as per requirements
		 * 
		 * @access			public
		 * @introduced		2022/01/17
		 * @return			object typeof QPage_Handler_Interface
		 */

		protected function create() : QPage_Handler_Interface {
			return new QPage_Handler_Cachable( new QPage_Handler_Page() );
		}
	}
	
?>