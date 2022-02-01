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
		 * @introduced				2022-01-16 [build date]
		 * @return					object typeof QDao
		 */
		 
		public function load( string $field_name ) : QDao { 
			return new QAppointments_Facade_Load( $field_name );
		}

		/**
		 * Perform an operation on the data source
		 *
		 * @param	$field_name			string
		 *
		 * @see		
		 * 
		 * @access					public
		 * @introduced				2022-01-16 [build date]
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
		 * @introduced				2022-01-16 [build date]
		 * @return					object typeof QDao
		 */
		 
		public function remove() : QDao { 
			return new QAppointments_Facade_Remove();
		}
		
		/**
		 * Perform an operation on the data source
		 *
		 * @see		
		 * 
		 * @access					public
		 * @introduced				2022-01-16 [build date]
		 * @return					object typeof QDao
		 */
		 
		public function booking() : QDao { 
			return new QAppointments_Facade_Booking();
		}
		
		/**
		 * Perform an operation on the data source
		 *
		 * @param	$field_name			array
		 *
		 * @see				
		 *
		 * @access					public
		 * @introduced				2022-01-16 [build date]
		 * @return					object typeof QDao
		 */
		 
		public function formFields( array $field_name ) : QDao { 
			return new QAppointments_Facade_Form_Fields( $field_name );
		}
		
		/**
		 * Return data suitable for use in a form control
		 *
		 * @param	$field_name			string
		 *
		 * @see				
		 *
		 * @access					public
		 * @introduced				2022-01-16 [build date]
		 * @return					object typeof QForm_Select_Control
		 */
		 
		public function formDashboard( string $field_name ) : QForm_Select_Control { 
			return new QAppointments_Facade_Form_Dashboard( $field_name );
		}
				
		/**
		 * Calculate the month [name] based on the current month, and an adjustment (increment)
		 *
		 * @param	$field_name			string
		 * @param	$adjustment			int
		 *
		 * @see		
		 * 
		 * @access					public
		 * @introduced				2022-01-17
		 * @return					object typeof QDao
		 */
		 
		public function calender( string $field_name, int $adjustment ) : QDao { 
			return new QAppointments_Facade_Calender( $field_name, $adjustment );
		}

		/**
		 * Generate flat array for calander, month view, based on a date
		 *
		 * @param	$field_name			string
		 * @param	$adjustment			int
		 *
		 * @see		
		 * 
		 * @access					public
		 * @introduced				2022-01-17
		 * @return					object typeof QDao
		 */
		 
		public function calenderWholeMonthByDay( string $field_name, int $adjustment ) : QDao { 
			return new QAppointments_Facade_Calender_Whole_Month_By_Day( $field_name, $adjustment );
		}

		/**
		 * Query the database for data, suitable for a form control
		 *
		 * @param	$field_name			string
		 *
		 * @see		
		 * 
		 * @access					public
		 * @introduced				2022-01-18
		 * @return					object typeof QForm_Select_Control
		 */
		 
		public function formControlSlots( string $field_name ) : QForm_Select_Control { 
			return new QAppointments_Form_Control_Slots_Decorator( $field_name, 
				new QAppointments_Form_Control_Slots( $field_name )
			);
		}

	}
	
?>