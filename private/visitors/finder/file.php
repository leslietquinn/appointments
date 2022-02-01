<?php

	final class QVisitors_Finder extends QFinder {

		/**
		 * Class constructor
		 * 
		 * @access				public
		 * @introduced			2022-01-19 [build date]
		 * @return				void
		 */

		public function __construct() {
			parent::__construct( new QVisitors_Statement() );
		}
		
		/**
		 * Return the name of $this class, formatted
		 * 
		 * @access				protected
		 * @introduced			2022-01-19 [build date]
		 * @return				string
		 */

		protected function getClassname() : string {
			return 'QVisitors_Record';
		}
		
	}
	
?>