<?php

	final class QPage_Handler_Head extends QPage_Handler {

		/**
		 * Class constructor
		 * 
		 * @access				public
		 * @introduced			2022-01-17
		 * @return				void
		 */

		public function __construct() {
			$this -> id = 'head';
		}
		
		/**
		 * Execute a process to generate a response
		 * 
		 * @param	$dataspace 			object typeof QDataspace_Interface 
		 * 
		 * @access				public
		 * @introduced			2022-01-17
		 * @return				void
		 */

		public function execute( QDataspace_Interface $dataspace ) : void {
			$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) );
			$page -> render( 'home/show/head.tpl' );
		}
	}
	
	final class QPage_Handler_Body extends QPage_Handler {

		/**
		 * Class constructor
		 * 
		 * @access				public
		 * @introduced			2022-01-17
		 * @return				void
		 */
		
		public function __construct() {
			$this -> id = 'body';

			/**
			 * @note	show a calender for any given three months, from current month
			 */

			$this -> attach( new QPage_Handler_Cachable( new QPage_Handler_Calender_Month_First() ) );
			$this -> attach( new QPage_Handler_Cachable( new QPage_Handler_Calender_Month_Second() ) );
			$this -> attach( new QPage_Handler_Cachable( new QPage_Handler_Calender_Month_Third() ) );
		}
		
		/**
		 * Execute a process to generate a response
		 * 
		 * @param	$dataspace 			object typeof QDataspace_Interface 
		 * 
		 * @access				public
		 * @introduced			2022-01-17
		 * @return				void
		 */

		public function execute( QDataspace_Interface $dataspace ) : void {
			$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) );
			$page -> render( 'home/show/body.tpl' );
		}
	}
	
	final class QPage_Handler_Calender_Month_First extends QPage_Handler {

		/**
		 * Class constructor
		 * 
		 * @access				public
		 * @introduced			2022-01-17
		 * @return				void
		 */
		
		public function __construct() {
			$this -> id = 'month-first';
		}
		
		/**
		 * Execute a process to generate a response
		 * 
		 * @param	$dataspace 			object typeof QDataspace_Interface 
		 * 
		 * @access				public
		 * @introduced			2022-01-17
		 * @return				void
		 */

		public function execute( QDataspace_Interface $dataspace ) : void {
			$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) );

			$facade = new QAppointments_Facade();
			$page -> operate( $facade -> calender( 'first', 0 ) );
			$page -> operate( $facade -> calenderWholeMonthByDay( 'first-calender', 0 ) );

			$page -> render( 'home/show/month-first.tpl' );
		}
	}

	final class QPage_Handler_Calender_Month_Second extends QPage_Handler {

		/**
		 * Class constructor
		 * 
		 * @access				public
		 * @introduced			2022-01-17
		 * @return				void
		 */
		
		public function __construct() {
			$this -> id = 'month-second';
		}
		
		/**
		 * Execute a process to generate a response
		 * 
		 * @param	$dataspace 			object typeof QDataspace_Interface 
		 * 
		 * @access				public
		 * @introduced			2022-01-17
		 * @return				void
		 */

		public function execute( QDataspace_Interface $dataspace ) : void {
			$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) );

			$facade = new QAppointments_Facade();
			$page -> operate( $facade -> calender( 'second', 1 ) );
			$page -> operate( $facade -> calenderWholeMonthByDay( 'second-calender', 1 ) );

			$page -> render( 'home/show/month-second.tpl' );
		}
	}

	final class QPage_Handler_Calender_Month_Third extends QPage_Handler {

		/**
		 * Class constructor
		 * 
		 * @access				public
		 * @introduced			2022-01-17
		 * @return				void
		 */
		
		public function __construct() {
			$this -> id = 'month-third';
		}
		
		/**
		 * Execute a process to generate a response
		 * 
		 * @param	$dataspace 			object typeof QDataspace_Interface 
		 * 
		 * @access				public
		 * @introduced			2022-01-17
		 * @return				void
		 */

		public function execute( QDataspace_Interface $dataspace ) : void {
			$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) );

			$facade = new QAppointments_Facade();
			$page -> operate( $facade -> calender( 'third', 2 ) );
			$page -> operate( $facade -> calenderWholeMonthByDay( 'third-calender', 2 ) );

			$page -> render( 'home/show/month-third.tpl' );
		}
	}

?>