<?php

	final class QVisitors_Statement implements QFinder_Statement_Interface {
		public function __construct() {}
		
		/**
		 * Return SQL to extract single record found for primary key
		 *
		 * @see		QVisitors_Finder::usingId( $id );
		 *
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 * @return				string 
		 */
		 
		public function loadUsingIdStatement() : string {
			return "select
						tb.* 
				   from visitors tb 
				  where tb.id = ?";
		}
		
		/**
		 * Return SQL to extract single record found for unique hash
		 *
		 * @see		QVisitors_Finder::usingHash( $hash );
		 *
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 * @return				string 
		 */
		 
		public function loadUsingHashStatement() : string {
			return "select
						tb.* 
				   from visitors tb 
				  where tb.hash = ?";
		}
		
		/**
		 * Return SQL to extract one or more records order by timestamp with limit 
		 *
		 * @see		QVisitors_Finder::findAll( $limitby );
		 *
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 * @return				string 
		 */
		 
		public function loadFindAllStatement() : string {
			return "select
						tb.* 
				   from visitors tb 
			   order by tb.timestamp desc 
			      limit 0, ?";
		}
		
		/**
		 * Return SQL to extract one or more records order by defined column without limit 
		 *
		 * @see		QVisitors_Finder::selectAll();
		 *
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 * @return				string 
		 */
		 
		public function loadSelectAllStatement() : string {
			return "select
						tb.id
					  , tb.name 
				   from visitors tb 
			   order by tb.name asc";
		}
		
		/**
		 * Return SQL to extract single record found for an email address
		 *
		 * @see		QVisitors_Finder::usingEmail( $email );
		 *
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 * @return				string 
		 */
		 
		public function loadUsingEmailStatement() : string {
			return "select
						tb.* 
				   from visitors tb 
				  where tb.email = ?";
		}
		
		/**
		 * Return SQL to extract single record found for unique session passphrase
		 *
		 * @see		QVisitors_Finder::usingPassphrase( $passphrase );
		 *
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 * @return				string 
		 */
		 
		public function loadUsingPassphraseStatement() : string {
			return "select
						tb.* 
				   from visitors tb 
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