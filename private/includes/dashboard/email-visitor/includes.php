<?php
	
	final class QPage_Handler_Head extends QPage_Handler {
		
		/**
		 * Class constructor
		 *
		 * @access			public
		 * @introduced		2022/01/22
		 *
		 * @return			void
		 */
		 
		public function __construct() {
			$this -> id = 'head';
		}
		
		/**
		 * Execute this $handler to produce a HTML composite, part of a response
		 *
		 * @param	$dataspace			object typeof QDataspace_Interface
		 *
		 * @access			public
		 * @introduced		2022/01/22
		 *
		 * @return			void
		 */
		 
		public function execute( QDataspace_Interface $dataspace ) {
			$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) );
			$page -> render( 'dashboard/email-visitor/head.tpl' );
		}
	}
	
	final class QPage_Handler_Body extends QPage_Handler {
		public function __construct() {
			$this -> id = 'body';
		}
		
		public function execute( QDataspace_Interface $dataspace ) {
			$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) );

			$facade = new QAppointments_Facade();
			$page -> operate( $facade -> load( 'appointment' ) );
			
			$page -> render( 'dashboard/email-visitor/body.tpl' );
		}
	}
	
?>