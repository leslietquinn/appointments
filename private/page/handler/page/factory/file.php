<?php

	final class QPage_Handler_Page_Factory extends QPage_Handler_Factory {
		public function __construct() {
			parent::__construct( array( 'head', 'body', 'foot', 'navigation' ) ); 
		}
		
		protected function create() {
			return new QPage_Handler_Cachable( new QPage_Handler_Page() );
		}
	}
	
?>