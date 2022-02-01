<?php
	
	final class QAppointments_Filter_Slots implements QFilter_Interface {
		private string $alternate_name;
		private string $field_name;

		private array $slots = array(
			'08'	=>	'08:00'
		  , '09' 	=>	'09:00'
		  ,	'10' 	=>	'10:00'
		  ,	'11'	=> 	'11:00'
		  , '12' 	=>	'12:00'
		  , '13' 	=>  '13:00'
		  , '14'	=>	'14:00'
		  , '15'	=>	'15:00'
		  , '16' 	=>	'16:00'
		);

		/**
		 * Class constructor
		 * 
		 * @param 	$field_name			string
		 * @param	$alternate_name		string
		 * 
		 * @access			public
		 * @introduced		2022/01/21
		 * @return			void
		 */

		public function __construct( string $field_name, string $alternate_name ) {
			$this -> alternate_name = $alternate_name;
			$this -> field_name = $field_name;
		}

		/**
		 * Process a filter on specific data; allocate a proper time to any given slot found
		 * 
		 * @access			public
		 * @introduced		2022/01/21
		 * @return			void
		 */

		public function process() : void {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			if( $dataspace -> has( $this -> field_name ) ) {
				$dataspace -> set( $this -> alternate_name, $this -> slots[$dataspace -> get( $this -> field_name )] );
			}
		}
	}

?>