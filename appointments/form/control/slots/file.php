<?php

	final class QAppointments_Form_Control_Slots extends QForm_Select_Control {

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
			$this -> field_name = $field_name;
			parent::__construct( 'id' );
		}
		
		/**
		 * Return data suitable for form control, an array of hourly slots
		 * 
		 * @access			public
		 * @introduced 		2022-01-16 [build date]
		 * @return 			array
		 */

		public function toArray() : array {
			return array(
				0 	=>	new QParameters(
					array(
						'id' 		=> 	'08'
					  , 'name'		=>	'08:00 am'
					  , 'ignore'	=>	'no'
					)
				)
			  , 1 	=>	new QParameters(
					array(
						'id' 		=> 	'09'
					  , 'name'		=>	'09:00 am'
					  , 'ignore'	=>	'no'
					)
				)
			  , 2	=>	new QParameters(
					array(
						'id' 		=> 	'10'
					  , 'name'		=>	'10:00 am'
					  , 'ignore'	=>	'no'
					)
				)
			  , 3 	=>	new QParameters(
					array(
						'id' 		=> 	'11'
					  , 'name'		=>	'11:00 am'
					  , 'ignore'	=>	'no'
					)
				)
			  , 4 	=>	new QParameters(
					array(
						'id' 		=> 	'12'
					  , 'name'		=>	'12 noon'
					  , 'ignore'	=>	'yes'
					)
				)
			  , 5	=>	new QParameters(
					array(
						'id' 		=> 	'13'
					  , 'name'		=>	'13:00 pm'
					  , 'ignore'	=>	'no'
					)
				)
			  , 6 	=>	new QParameters(
					array(
						'id' 		=> 	'14'
					  , 'name'		=>	'14:00 pm'
					  , 'ignore'	=>	'no'
					)
				)
			  , 7 	=>	new QParameters(
					array(
						'id' 		=> 	'15'
					  , 'name'		=>	'15:00 pm'
					  , 'ignore'	=>	'no'
					)
				)
			  , 8 	=>	new QParameters(
					array(
						'id' 		=> 	'16'
					  , 'name'		=>	'16:00 pm'
					  , 'ignore'	=>	'no'
					)
				)
			);
		}
	}
	
?>