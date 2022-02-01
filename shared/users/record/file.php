<?php

	final class QUsers_Record extends QRecord {
		protected $parameters = array(
			'id'			=>	null,
			'code'			=>	null,
			'name'			=>	null,
			'email'			=>	null,
			'active'		=>	null,
			'password'		=>	null,
			'timestamp'		=>	null,
			'passphrase'	=>	null );
			
		protected $primary_keys = array( 'id' );
		
		public function __construct( $id = false ) {
			parent::__construct( $id );
		}
		
		protected function insertStatement() : string {
			return "insert into users set 
					id = ?
				  , code = ?
				  , name = ?
				  , email = ?
				  , active = ?
				  , password = ?
				  , timestamp = ?
				  , passphrase = ?";			
		}
		
		protected function updateStatement() : string {
			return "update users set 
				    code = ?
				  , name = ?
				  , email = ?
				  , active = ?
				  , password = ?
				  , timestamp = ?
				  , passphrase = ?
			  where id = ?";
		}
		
		protected function deleteStatement() : string {
			return "delete from users where id = ?";
		}
		
		protected function loadStatement() : string {
			return "select * from users where id = ?";
		}
	}
	
?>