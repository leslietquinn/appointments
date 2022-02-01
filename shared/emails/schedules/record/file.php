<?php

	final class QEmails_Schedules_Record extends QRecord {
		protected $parameters = array(
			'id'			=>	null,
			'code'			=>	null,
			'email'			=>	null,
			'status'		=>	null,
			'subject'		=>	null,
			'from_date'		=>	null,
			'processor'		=>	null,
			'timestamp'		=>	null );
			
		protected $primary_keys = array( 'id' );
		
		public function __construct( $id = false ) {
			parent::__construct( $id );
		}
		
		protected function insertStatement() : string {
			return "insert into emails_schedules set 
					id = ?
				  , code = ?
				  , email = ?
				  , status = ?
				  , subject = ?
				  , from_date = ?
				  , processor = ?
				  , timestamp = ?";			
		}
		
		protected function updateStatement() : string {
			return "update emails_schedules set 
				    code = ?
				  , email = ?
				  , status = ?
				  , subject = ?
				  , from_date = ?
				  , processor = ?
				  , timestamp = ?
			  where id = ?";
		}
		
		protected function deleteStatement() : string {
			return "delete from emails_schedules where id = ?";
		}
		
		protected function loadStatement() : string {
			return "select * from emails_schedules where id = ?";
		}
	}
	
?>