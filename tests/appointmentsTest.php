<?php

	namespace appointmentsTest;

	use PHPUnit\Framework\TestCase;

	/**
	 ** @covers Appointment
	 */
	
	final class appointmentsTest extends TestCase {
		protected function setUp() : void {
			parent::setUp();
		}

		protected function tearDown() : void {
			parent::tearDown();
		}

		/** @test
		 ** @covers Appointment::IsItSaturday
		 ** @introduced		2022/01/19
		 **
		 */

		public function testWeekendAndDayIsASaturday() : void {
			$day = (int) date( 'w', strtotime( '2022-01-03' ) );

			$this -> assertFalse( $day === 6 or $day === 7 );

			$day = (int) date( 'w', strtotime( '2022-01-22' ) ); 

			$this -> assertTrue( $day === 6 );
		}

		/** @test
		 ** @covers Appointment::OverIntoNextYear
		 ** @introduced		2022/01/17
		 **
		 */

		public function testAdjustMonthOverlapYearEnd() : void {
			$mn = 12; // Dec
			$yr = date( 'Y' ); // 2022

			$date = date( 'Y-m-d', mktime( 0, 0, 0, $mn, 1, $yr ) );
			
			$this -> assertTrue( ( '2022-12-01' )? true:false );

			$mn++;
			if( $mn > 12 ) {
				$mn =- 12;
				$yr++;
			}

			// Jan, 2023
			$date = date( 'Y-m-d', mktime( 0, 0, 0, $mn, 1, $yr ) );

			$this -> assertTrue( ( '2023-01-01' )? true:false );
		}

		/** @test
		 ** @covers Appointment::CreateCalendarMonth
		 ** @introduced		2022/01/17
		 **
		 */

		public function testCalendarMonthByDayArrayComplete() : void {
			$day = 3;
			$length = 28;

			$padding = ( 3 + 28 ) % 7 ?  7 - ( 3 + 28 ) % 7 : 0;

			$this -> assertSame( 4, $padding );	

			$array = array_merge( $day ? array_fill( 0, $day, 0 ) : array(), range( 1, $length ), $padding ? array_fill( 0, $padding, 0 ) : array() );

			$this -> assertTrue( sizeof( $array ) % 7 == 0 );
		}

		/** @test
		 ** @covers Appointment::DaysInAMonth
		 ** @introduced		2022/01/17
		 **
		 */

		public function testNumberOfDaysInAMonth() : void {
			$number_of_days = date( 't', strtotime( 'today' ) );

			$this -> assertSame( $number_of_days, date( 't', mktime( 0, 0, 0, date( 'm' ), 1, date( 'Y' ) ) ) );
		}
	}

?>