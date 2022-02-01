<?php

	final class QEmails_Record extends QRecord {
		protected $parameters = array(
			'id'			=>	null,
			'body'			=>	null,
			'hash'			=>	null,
			'email'			=>	null,
			'subject'		=>	null,
			'timestamp'		=>	null );
			
		protected $primary_keys = array( 'id' );
		
		public function __construct( $id = false ) {
			parent::__construct( $id );
		}
		
		protected function insertStatement() : string {
			return "insert into emails set 
					id = ?
				  , body = ?
				  , hash = ?
				  , email = ?
				  , subject = ?
				  , timestamp = ?";			
		}
		
		protected function updateStatement() : string {
			return "update emails set 
				    body = ?
				  , hash = ?
				  , email = ?
				  , subject = ?
				  , timestamp = ?
			  where id = ?";
		}
		
		protected function deleteStatement() : string {
			return "delete from emails where id = ?";
		}
		
		protected function loadStatement() : string {
			return "select * from emails where id = ?";
		}
	}
	
?>