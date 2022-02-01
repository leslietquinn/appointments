<?php
	
	final class QPage_Handler_Head extends QPage_Handler {
		public function __construct() {
			$this -> id = 'head';
		}
		
		public function execute( QDataspace_Interface $dataspace ) {
			$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) );
			$page -> render( 'dashboard/head.tpl' );
		}
	}
	
	final class QPage_Handler_Body extends QPage_Handler {
		public function __construct() {
			$this -> id = 'body';

			$this -> attach( new QPage_Handler_Cachable( new QPage_Handler_Appointments() ) );
		}
		
		public function execute( QDataspace_Interface $dataspace ) {
			$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) );
			$page -> render( 'dashboard/body.tpl' );
		}
	}
	
	final class QPage_Handler_Appointments extends QPage_Handler {
		public function __construct() {
			$this -> id = 'appointments';

			$this -> attach( new QPage_Handler_Cachable( new QPage_Handler_Appointments_Open() ) );
			$this -> attach( new QPage_Handler_Cachable( new QPage_Handler_Appointments_Confirmed() ) );
		}
		
		public function execute( QDataspace_Interface $dataspace ) {
			$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) );
			$page -> render( 'dashboard/appointments/body.tpl' );
		}
	}

	final class QPage_Handler_Appointments_Open extends QPage_Handler {
		public function __construct() {
			$this -> id = 'open';
		}
		
		public function execute( QDataspace_Interface $dataspace ) {
			$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) );
			$page -> render( 'dashboard/appointments/open.tpl' );
		}
	}

	final class QPage_Handler_Appointments_Confirmed extends QPage_Handler {
		public function __construct() {
			$this -> id = 'confirmed';
		}
		
		public function execute( QDataspace_Interface $dataspace ) {
			$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) );
			$page -> render( 'dashboard/appointments/confirmed.tpl' );
		}
	}

?>