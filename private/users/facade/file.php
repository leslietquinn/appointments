<?php

	final class QUsers_Facade {
		public function __construct() {}
		
		/**
		 * Perform an operation on the data source
		 *
		 * @param	$field_name			string
		 *
		 * @see		
		 * 
		 * @access					public
		 * @introduced				2022-01-19 [build date]
		 * @return					object typeof QDao
		 */
		 
		public function load( string $field_name ) : QDao { 
			return new QUsers_Facade_Load( $field_name );
		}

		/**
		 * Perform an operation on the data source
		 *
		 * @param	$field_name			string
		 *
		 * @see		
		 * 
		 * @access					public
		 * @introduced				2022-01-19 [build date]
		 * @return					object typeof QDao
		 */
		 
		public function all( string $field_name ) : QDao { 
			return new QUsers_Facade_All( $field_name );
		}
		
		/**
		 * Perform an operation on the data source
		 *
		 * @see		
		 * 
		 * @access					public
		 * @introduced				2022-01-19 [build date]
		 * @return					object typeof QDao
		 */
		 
		public function remove() : QDao { 
			return new QUsers_Facade_Remove();
		}
		
		/**
		 * Perform an operation on the data source
		 *
		 * @param	$field_name			array
		 *
		 * @see				
		 *
		 * @access					public
		 * @introduced				2022-01-19 [build date]
		 * @return					object typeof QDao
		 */
		 
		public function formFields( array $field_name ) : QDao { 
			return new QUsers_Facade_Form_Fields( $field_name );
		}
		
		/**
		 * Return data suitable for use in a form control
		 *
		 * @param	$field_name			string
		 *
		 * @see				
		 *
		 * @access					public
		 * @introduced				2022-01-19 [build date]
		 * @return					object typeof QForm_Select_Control
		 */
		 
		public function formDashboard( string $field_name ) : QForm_Select_Control { 
			return new QUsers_Facade_Form_Dashboard( $field_name );
		}
				
		/**
		 * Validate credentials and redirect if good
		 *
		 * @param	$redirect			string
		 *
		 * @access			public
		 * @introduced		2022/01/19 [build date]
		 *
		 * @see				QHome_Action_Dispatcher::show();
		 *
		 * @return			obect typeof QDao
		 */
		 
		public function validateCredentials( string $redirect ) : QDao { 
			return new QUsers_Facade_Validate_Credentials( $redirect );
		}
		
		/**
		 * Verify sign in details exists or not, and redirect if not
		 *
		 * @access			public
		 * @introduced		2022/01/19 [build date]
		 *
		 * @see				QUsers_Plugin_Secure_Access::process();
		 * @see				QHome_Action_Dispatcher::show();
		 *
		 * @return			obect typeof QDao
		 */
		 
		public function verifyPassphrase() : QDao { 
			return new QUsers_Facade_Verify_Passphrase();
		}
	}
	
?>