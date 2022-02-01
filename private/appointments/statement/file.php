<?php

	final class QAppointments_Statement implements QFinder_Statement_Interface {
		public function __construct() {}
		
		/**
		 * Return SQL to extract single record found by primary key
		 *
		 * @access				public
		 * @introduced			2022-01-19 [build date]
		 * @return				string
		 */
		 
		public function loadOneStatement() {}
		
		/**
		 * Return SQL to extract multiple records in descending order of timestamp
		 *
		 * @access				public
		 * @introduced			2022-01-19 [build date]
		 * @return				string
		 */
		 
		public function loadAllStatement() {}
				
	}
	
?>