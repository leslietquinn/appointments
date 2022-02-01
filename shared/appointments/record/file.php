<?php

	final class QAppointments_Record extends QRecord {
		protected $parameters = array( 'id'=>null,'open'=>null,'slot'=>null,'session'=>null,'confirmed'=>null,'timestamp'=>null,'rescheduled'=>null );
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
			return "insert into appointments set id=?,open=?,slot=?,session=?,confirmed=?,timestamp=?,rescheduled=?";
		}
		
		/**
		 * Return SQL to update data to a database table, one row only
		 * 
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 * @return				string
		 */

		protected function updateStatement() : string {
			return "update appointments set open=?,slot=?,session=?,confirmed=?,timestamp=?,rescheduled=? where id = ?";
		}
		
		/**
		 * Return SQL to delete data to a database table, one row only
		 * 
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 * @return				string
		 */

		protected function deleteStatement() : string {
			return "delete from appointments where id = ?";
		}
		
		/**
		 * Return SQL to load data to a database table, one row only
		 * 
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 * @return				string
		 */

		protected function loadStatement() : string {
			return "select * from appointments where id = ?";
		}
	}
	
?>