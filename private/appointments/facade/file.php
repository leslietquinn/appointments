<?php

	final class QAppointments_Facade {
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
			return new QAppointments_Facade_Load( $field_name );
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
		 
		public function change() : QDao { 
			return new QAppointments_Facade_Change();
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
			return new QAppointments_Facade_All( $field_name );
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
			return new QAppointments_Facade_Remove();
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
			return new QAppointments_Facade_Form_Fields( $field_name );
		}
		
		/**
		 * Perform an operation on the data source
		 *
		 * @see				
		 *
		 * @access					public
		 * @introduced				2022-01-23 [last modified]
		 * @return					object typeof QDao
		 */
		 
		public function email() : QDao { 
			return new QAppointments_Facade_Email();
		}
		
		/**
		 * Perform an operation on the data source
		 *
		 * @see				
		 *
		 * @access					public
		 * @introduced				2022-01-23 [last modified]
		 * @return					object typeof QDao
		 */
		 
		public function automatedEmail() : QDao { 
			return new QAppointments_Facade_Email_Automated( 
				new QAppointments_Facade_Email()
			);
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
			return new QAppointments_Facade_Form_Dashboard( $field_name );
		}
				
		/**
		 * Form control; return all rows of data, those that are open
		 * 
		 * @note	returns columns ap.id, ap.slot, ap.session, vi.fullname, vi.email, vi.telephone
		 * 
		 * @param	$field_name			string
		 *
		 * @access			public
		 * @introduced		2022/01/21
		 *
		 * @return			object typeof QForm_Select_Control
		 */
		 
		public function formDashboardAllOpen( string $field_name ) : QForm_Select_Control { 
			return new QAppointments_Facade_Form_Dashboard_All_Open( $field_name );
		}
				
		/**
		 * Form control; return all rows of data, those that are open
		 * 
		 * @note	returns columns ap.id, ap.slot, ap.session, vi.fullname, vi.email, vi.telephone
		 * 
		 * @param	$field_name			string
		 *
		 * @access			public
		 * @introduced		2022/01/21
		 *
		 * @return			object typeof QForm_Select_Control
		 */
		 
		public function formDashboardAllConfirmed( string $field_name ) : QForm_Select_Control { 
			return new QAppointments_Facade_Form_Dashboard_All_Confirmed( $field_name );
		}
		
	}
	
?>