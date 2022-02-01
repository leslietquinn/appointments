<?php

	final class QVisitors_Record extends QRecord {
		protected $parameters = array( 'id'=>null,'email'=>null,'token'=>null,'fullname'=>null,'telephone'=>null,'timestamp'=>null );
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
			return "insert into visitors set id=?,email=?,token=?,fullname=?,telephone=?,timestamp=?";
		}
		
		/**
		 * Return SQL to update data to a database table, one row only
		 * 
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 * @return				string
		 */

		protected function updateStatement() : string {
			return "update visitors set email=?,token=?,fullname=?,telephone=?,timestamp=? where id = ?";
		}
		
		/**
		 * Return SQL to delete data to a database table, one row only
		 * 
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 * @return				string
		 */

		protected function deleteStatement() : string {
			return "delete from visitors where id = ?";
		}
		
		/**
		 * Return SQL to load data to a database table, one row only
		 * 
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 * @return				string
		 */

		protected function loadStatement() : string {
			return "select * from visitors where id = ?";
		}
	}
	
?>