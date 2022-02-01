<?php

	final class QPage_Handler_Page extends QPage_Handler {
		public function __construct() {
			$this -> id = 'page';
		}
		
		public function execute( QDataspace_Interface $dataspace ) {
			$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) );
			$page -> render( 'template.tpl' );
		}
		
		public function isCachable() {
			return QCache::NO_CACHE;
		}
	}
	
?>
