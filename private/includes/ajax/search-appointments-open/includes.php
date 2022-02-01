<?php
	
	final class QPage_Handler_Page extends QPage_Handler {
		
		/**
		 * Class constructor
		 *
		 * @access			public
		 * @introduced		2022/01/21
		 *
		 * @return			void
		 */
		 
		public function __construct() {
			$this -> id = 'page';
		}
		
		/**
		 * Execute this $handler to produce a HTML composite, part of a response
		 *
		 * @param	$dataspace			object typeof QDataspace_Interface
		 *
		 * @access			public
		 * @introduced		2022/01/21
		 *
		 * @return			void
		 */
		 
		public function execute( QDataspace_Interface $dataspace ) : void {
			$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) );
			
			$facade = new QAppointments_Facade();
			$page -> operate( $facade -> formDashboardAllOpen( 'open' ) );

			$page -> render( 'ajax/search-appointments-open/template.tpl' );
		}
	}
	
?>