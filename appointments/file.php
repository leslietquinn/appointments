<?php

	final class QAppointments implements QAppointments_Interface {
		
		/**
		 * Class constructor
		 * 
		 * @access			public
		 * @introduced		2022/01/16 [build date]
		 * @return			void
		 */

		public function __construct() {}
		
		/**
		 * Return the current day of the week, present day
		 * 
		 * @param 	$date 		string
		 * 
		 * @access			public
		 * @introduced		2022/01/17
		 * @return			int
		 * @throws			QAppointments_Exception
		 */

		public function dayOfTheWeek( string $date ) : int { 
			if( !QInterval_Date::validate( $date ) ) {
				throw new QAppointments_Exception( 'thrown exception: illegal date format [app/appointments/] 28' );
			}

			$parts = QInterval_Date::splitDate( $date );

			return date( 'w', 
				mktime( 
					0
				  , 0
				  , 0
				  , $parts[1]
				  , $parts[2]
				  , $parts[0]
			  	)
			);
		}

		/**
		 * Return the number of days of a given date
		 * 
		 * @param 	$date 			string
		 * 
		 * @access			public
		 * @introduced		2022/01/17
		 * @return			int
		 * @throws			QAppointments_Exception 
		 */

		public function numberOfDaysInAMonth( string $date ) : int { 
			if( !QInterval_Date::validate( $date ) ) {
				throw new QAppointments_Exception( 'thrown exception: illegal date format [app/appointments/] 58' );
			}

			$parts = QInterval_Date::splitDate( $date );

			/**
			 * @note 	for the day, do not put 0 because that pushes the calculation to use the
			 * 			previous month; use 1 instead, the first day of a month
			 */

			return date( 't', 
				mktime( 
					0
				  , 0
				  , 0
				  , $parts[1]
				  , 1
				  , $parts[0] 
				) 
			);
		}

		/**
		 * Generate a calendar month as a flat array, with days
		 * 
		 * @param 	$date 			string
		 * 
		 * @access			public
		 * @introduced		2022/01/17
		 * @return			array
		 */

		public function calenderWholeMonthByDay( string $date ) : array { 
			$days_in_the_month = $this -> numberOfDaysInAMonth( $date ); 
			$day_of_the_week = $this -> dayOfTheWeek( $date );
			
			/**
			 * @note 	pad out the end of the month
			 */

			$padding = ( $day_of_the_week + $days_in_the_month ) % 7 ?  7 - ( $day_of_the_week + $days_in_the_month ) % 7 : 0;
			
			/**
			 * @note 	now fill out the end of the month, to make an equal length 
			 * 			what ever the month is
			 */

			$array = array_merge( $day_of_the_week ? array_fill( 0, $day_of_the_week, 0 ) : array(), range( 1, $days_in_the_month ), $padding ? array_fill( 0, $padding, 0 ) : array() );

			array_shift( $array ); 
			array_push( $array, 0 );

			return $array;
		}

		/**
		 * Ensure that a month is always going to fall in a valid date
		 * 
		 * @param 	$month 				int
		 * 
		 * @access			public
		 * @introduced		2022/01/17
		 * @return			int
		 * @throws 			Appointments_Exception		
		 */

		public function adjustToMonth( int $month ) : int { 
			$yr = date( 'Y' );

			if( $month > 12 ) {

				/**
				 * @note 	going over, into the next year now
				 */

				$month =- 12;
				$yr++;
			}
			
			if( !QInterval_Date::validate( date( 'Y-m-d', mktime( 0, 0, 0, $month, 1, date( 'Y' ) ) ) ) ) {
				throw new QAppointments_Exception( 'thrown exception: illegal date [app/appointments] 139' );
			}

			return $month;
		}

		/**
		 * Determine if the $date given is in the past or not
		 * 
		 * @param 	$date 			string
		 * 
		 * @access 				public
		 * @introduced 			2022/01/18
		 * @return 				bool
		 * @throws				QAppointment_Exception
		 */

		public function determineIfInThePast( string $date ) : bool {
			if( !QInterval_Date::validate( $date ) ) {
				throw new QAppointments_Exception( 'thrown exception: illegal date format [app/appointments] 152' );
			}

			/**
			 * @note 	take into account today, remove 24 hours
			 */

			$now = time() - QInterval::DAY;
			$day = strtotime( $date ); 

			if( $now >= $day ) {
				return true;
			}

			return false;
		}

		/**
		 * Determine if a date falls within a weekend day
		 * 
		 * @param	$date 			string
		 * 
		 * @access				public
		 * @introduced			2022/01/19
		 * @return				bool
		 * @throws				QAppointments_Exception
		 */

		public function isAWeekendDay( string $date ) : bool {
			if( !QInterval_Date::validate( $date ) ) {
				throw new QAppointments_Exception( 'thrown exception: illegal date format [app/appointments] 182' );
			}

			if( in_array( date( 'D', strtotime( $date ) ), [ 'Sat', 'Sun' ] ) ) {
				return true;
			}

			return false;
		}

	}

?>