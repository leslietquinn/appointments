<?php

	final class QAppointments_Visitors_Form_Control extends QForm_Select_Control {
		protected $finder = null;
		
		/**
		 * Class constructor
		 * 
		 * @param	$field_name 		string
		 * 
		 * @access			public
		 * @introduced 		2022-01-16 [build date]
		 * @return 			void
		 */
		 
		public function __construct( string $field_name ) {
			$this -> finder = new QAppointments_Visitors_Finder();
			$this -> field_name = $field_name;
			parent::__construct( 'id' );
		}
		
		/**
		 * Return data suitable for form control
		 * 
		 * @access			public
		 * @introduced 		2022-01-16 [build date]
		 * @return 			array
		 */

		public function toArray() : array {
			return $this -> finder -> selectAll();
		}
	}
	
?>