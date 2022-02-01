<?php

	final class QPage_Handler_Foot extends QPage_Handler {
		public function __construct() {
			$this -> id = 'foot';
		}
		
		public function execute( QDataspace_Interface $dataspace ) {
			$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) );
			$page -> render( 'foot.tpl' );
		}
		
		public function isCachable() {
			return QCache::NO_CACHE;
		}
	}
	
?>
