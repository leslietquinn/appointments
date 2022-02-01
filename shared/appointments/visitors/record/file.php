<?php

	final class QAppointments_Visitors_Record extends QRecord {
		protected $parameters = array( 'id'=>null,'visitor'=>null,'timestamp'=>null,'appointment'=>null );
		protected $primary_keys = array( 'id' );
		
		/**
		 * Class constructor
		 * 
		 * @param 	$id			mixed
		 * 
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 * @return			void
		 */

		public function __construct( $id = false ) {
			parent::__construct( $id );
		}
		
		/**
		 * Return SQL to insert data to a database table, one row only
		 * 
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 * @return				string
		 */

		protected function insertStatement() : string {
			return "insert into appointments_visitors set id=?,visitor=?,timestamp=?,appointment=?";
		}
		
		/**
		 * Return SQL to update data to a database table, one row only
		 * 
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 * @return				string
		 */

		protected function updateStatement() : string {
			return "update appointments_visitors set visitor=?,timestamp=?,appointment=? where id = ?";
		}
		
		/**
		 * Return SQL to delete data to a database table, one row only
		 * 
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 * @return				string
		 */

		protected function deleteStatement() : string {
			return "delete from appointments_visitors where id = ?";
		}
		
		/**
		 * Return SQL to load data to a database table, one row only
		 * 
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 * @return				string
		 */

		protected function loadStatement() : string {
			return "select * from appointments_visitors where id = ?";
		}
	}
	
?>