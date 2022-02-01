<?php
	
	final class QAppointments_Facade_Booking extends QDao implements QAcceptee_Interface {
		
		/**
		 * Class constructor
		 *
		 * @access			public
		 * @introduced		2022-01-16 [build date]
		 * @return			void
		 */
		 
		public function __construct() {}
		
		/**
		 * Perform an operation and pass it onto $acceptable
		 *
		 * @param	$acceptable			object typeof QDataspace_Interface
		 *
		 * @see				QAppointments_Facade::booking();
		 * @see 			QVisitors::processBooking();
		 *
		 * @access			public
		 * @introduced		2022-01-16 [build date]
		 * @return			bool
		 * @throws			QPage_Exception
		 */
		 
		public function push( $acceptable ) : bool {
			if( !( $acceptable instanceof QDataspace_Interface or $acceptable instanceof QPage_Interface ) ) {
				throw new QPage_Exception( 'thrown exception: unsupported interface [./appointments/facade/booking] 31' );
			}
			
			if( !$acceptable -> has( '__date__' ) ) {
				throw new QPage_Exception( 'thrown exception: missing data or corrupt request [./appointments/facade/booking] 35' );
			}
			
			$visitor = new QVisitors_Record();
			$visitor -> addFilter( new QFilter_Date_Now( 'timestamp' ) );
			$visitor -> addFilter( new QFilter_Random( 'id', QCommon::PK_BIG ) );
			$visitor -> addFilter( new QFilter_Set_Default( 'fullname', $acceptable -> get( 'fullname' ) ) );
			$visitor -> addFilter( new QFilter_Set_Default( 'telephone', $acceptable -> get( 'telephone' ) ) );
			$visitor -> addFilter( new QFilter_Set_Default( 'email', $acceptable -> get( 'email' ) ) );
			$visitor -> addFilter( new QFilter_Random( 'token', 6, 'unique' ) );
			$visitor -> addFilter( new QFilter_Sanitise_Escape( 'telephone', ENT_QUOTES ) );
			$visitor -> addFilter( new QFilter_Sanitise_Escape( 'fullname', ENT_QUOTES ) );
			$visitor -> addFilter( new QFilter_Sanitise_Email( 'email' ) );
			$visitor -> process();

			$visitor -> addFilter( new QFilter_String_Capitalise( 'fullname' ) );
			$visitor -> addFilter( new QFilter_String_Lowercase( 'email' ) );
			$visitor -> process();

			$appointment = new QAppointments_Record();
			$appointment -> addFilter( new QFilter_Date_Now( 'timestamp' ) );
			$appointment -> addFilter( new QFilter_Random( 'id', QCommon::PK_BIG ) );
			$appointment -> addFilter( new QFilter_Set_Default( 'open', 'yes' ) );
			$appointment -> addFilter( new QFilter_Set_Default( 'session', $acceptable -> get( '__date__' ) ) );
			$appointment -> addFilter( new QFilter_Set_Default( 'slot', $acceptable -> get( 'slot' ) ) );
			$appointment -> addFilter( new QFilter_Set_Default( 'rescheduled', 'no' ) );
			$appointment -> addFilter( new QFilter_Set_Default( 'confirmed', 'no' ) );
			$appointment -> process();

			$appointment_visitor = new QAppointments_Visitors_Record();
			$appointment_visitor -> addFilter( new QFilter_Date_Now( 'timestamp' ) );
			$appointment_visitor -> addFilter( new QFilter_Random( 'id', QCommon::PK_BIG ) );
			$appointment_visitor -> addFilter( new QFilter_Set_Default( 'visitor', $visitor -> get( 'id' ) ) );
			$appointment_visitor -> addFilter( new QFilter_Set_Default( 'appointment', $appointment -> get( 'id' ) ) );
			$appointment_visitor -> process();

			try {
				$this -> getConnection() -> begin();

				$visitor -> insert();
				$appointment -> insert();
				$appointment_visitor -> insert();
				$this -> getConnection() -> commit();

				$acceptable -> get( 'session' ) -> set( QCommon::TMP, $appointment -> get( 'id' ) );
				return true;
			} catch( QDb_Exception $e ) {
				$this -> getConnection() -> rollback();
				throw new QPage_Exception( $e -> getMessage() );
			}

			return false;
		}		
	}
	
?>