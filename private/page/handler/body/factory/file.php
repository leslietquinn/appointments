<?php

	final class QPage_Handler_Body_Factory extends QPage_Handler_Factory {
		public function __construct() {
			parent::__construct( array( 'alerts' ) ); 
		}
		
		protected function create() {
			return new QPage_Handler_Cachable( new QPage_Handler_Body() );
		}
	}
	
?>