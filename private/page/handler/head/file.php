<?php

	final class QPage_Handler_Head extends QPage_Handler {
		public function __construct() {
			$this -> id = 'head';
		}
		
		public function execute( QDataspace_Interface $dataspace ) {
			$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) );
			$page -> render( 'head.tpl' );
		}
		
		public function isCachable() {
			return QCache::NO_CACHE;
		}
	}
	
?>
