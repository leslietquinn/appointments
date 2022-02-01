<?php

	final class QAppointments_Statement implements QFinder_Statement_Interface {
		public function __construct() {}
		
		/**
		 * Return SQL to extract single record found for primary key
		 *
		 * @see		QAppointments_Finder::usingId( $id );
		 *
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 * @return				string 
		 */
		 
		public function loadUsingIdStatement() : string {
			return "select
						tb.* 
				   from appointments tb 
				  where tb.id = ?";
		}
		
		/**
		 * Return SQL to extract single record found for unique hash
		 *
		 * @see		QAppointments_Finder::usingHash( $hash );
		 *
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 * @return				string 
		 */
		 
		public function loadUsingHashStatement() : string {
			return "select
						tb.* 
				   from appointments tb 
				  where tb.hash = ?";
		}
		
		/**
		 * Return SQL to extract one or more records order by timestamp with limit 
		 *
		 * @see		QAppointments_Finder::findAll( $limitby );
		 *
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 * @return				string 
		 */
		 
		public function loadFindAllStatement() : string {
			return "select
						tb.* 
				   from appointments tb 
			   order by tb.timestamp desc 
			      limit 0, ?";
		}
		
		/**
		 * Return SQL to extract one or more records order by defined column without limit 
		 *
		 * @see		QAppointments_Finder::selectAll();
		 *
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 * @return				string 
		 */
		 
		public function loadSelectAllStatement() : string {
			return "select
						tb.id
					  , tb.name 
				   from appointments tb 
			   order by tb.name asc";
		}
		
		/**
		 * Return SQL to extract single record found for an email address
		 *
		 * @see		QAppointments_Finder::usingEmail( $email );
		 *
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 * @return				string 
		 */
		 
		public function loadUsingEmailStatement() : string {
			return "select
						tb.* 
				   from appointments tb 
				  where tb.email = ?";
		}
		
		/**
		 * Return SQL to extract single record found for unique session passphrase
		 *
		 * @see		QAppointments_Finder::usingPassphrase( $passphrase );
		 *
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 * @return				string 
		 */
		 
		public function loadUsingPassphraseStatement() : string {
			return "select
						tb.* 
				   from appointments tb 
				  where tb.passphrase = ?";
		}
		
		/**
		 * Return SQL to extract single record found by primary key
		 *
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 * @return				string
		 */
		 
		public function loadOneStatement() {}
		
		/**
		 * Return SQL to extract multiple records in descending order of timestamp
		 *
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 * @return				string
		 */
		 
		public function loadAllStatement() {}
				
	}
	
?>