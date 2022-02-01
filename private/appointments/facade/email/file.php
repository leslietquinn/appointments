<?php
	
	final class QAppointments_Facade_Email extends QDao implements QAcceptee_Interface {
		
		/**
		 * Class constructor
		 *
		 * @access			public
		 * @introduced		2022-01-19 [build date]
		 * @return			void
		 */
		 
		public function __construct() {}
		
		/**
		 * Perform an operation and pass it onto $acceptable
		 *
		 * @param	$acceptable			object typeof QDataspace_Interface
		 *
		 * @see				QAppointments_Facade::email();
		 * @see 			QDashboard::emailVisitor();
		 *
		 * @access			public
		 * @introduced		2022-01-19 [build date]
		 * @return			bool
		 * @throws			QPage_Exception
		 */
		 
		public function push( $acceptable ) : bool {
			if( !( $acceptable instanceof QDataspace_Interface or $acceptable instanceof QPage_Interface ) ) {
				throw new QPage_Exception( 'thrown exception: unsupported interface [./appointments/facade/email] 31' );
			}
			
			$record = new QAppointments_Record( $acceptable -> get( 'id' ) );
			
			if( !$record -> has( 'id' ) ) {
				throw new QPage_Exception( 'thrown exception: invalid primary key given [./appointments/facade/email] 37' );
			}
			
			/**
			 * @note 	first, find the $row of data from the Appointments_Visitors database table using the Appointments 
			 * 			primary key; $record
			 */

			try {
				$appointment_visitor = $this -> queryDb( $record -> get( 'id' ) );
			} catch( QDb_Exception $e ) {
				throw new QPage_Exception( $e -> getMessage() );
			}

			$visitor = new QVisitors_Record( $appointment_visitor -> get( 'visitor' ) );

			$email = new QEmails_Record();
			$email -> addFilter( new QFilter_Date_Now( 'timestamp' ) );
			$email -> addFilter( new QFilter_Random( 'id', QCommon::PK_BIG ) );
			$email -> addFilter( new QFilter_Set_Default( 'subject', $acceptable -> get( 'subject' ) ) );
			$email -> addFilter( new QFilter_Set_Default( 'email', $visitor -> get( 'email' ) ) );
			$email -> addFilter( new QFilter_Set_Default( 'body', $acceptable -> get( 'body' ) ) );
			$email -> addFilter( new QFilter_Random( 'hash', 32, 'unique' ) );
			$email -> addFilter( new QFilter_Sanitise_Email( 'email' ) );
			$email -> process();

			$email -> addFilter( new QFilter_String_Capitalise( 'subject' ) );
			$email -> addFilter( new QFilter_Sanitise_Escape( 'email', ENT_QUOTES ) );
			$email -> addFilter( new QFilter_String_Lowercase( 'email' ) );
			$email -> addFilter( new QFilter_Sanitise_Html( 'body' ) );
			$email -> addFilter( new QFilter_Encode_Base64( 'body' ) );
			$email -> process();

			$schedule = new QEmails_Schedules_Record();
			$schedule -> addFilter( new QFilter_Date_Now( 'from_date' ) );
			$schedule -> addFilter( new QFilter_Date_Now( 'timestamp' ) );
			$schedule -> addFilter( new QFilter_Random( 'id', QCommon::PK_BIG ) );
			$schedule -> addFilter( new QFilter_Set_Default( 'subject', $email -> get( 'subject' ) ) );
			$schedule -> addFilter( new QFilter_Set_Default( 'email', $email -> get( 'email' ) ) );
			$schedule -> addFilter( new QFilter_Set_Default( 'code', $email -> get( 'hash' ) ) );
			$schedule -> addFilter( new QFilter_Set_Default( 'processor', $acceptable -> get( 'processor' ) ) );
			$schedule -> addFilter( new QFilter_Set_Default( 'status', 'active' ) );
			$schedule -> process();

			$record -> addFilter( new QFilter_Set_Default( 'confirmed', 'yes' ) );
			$record -> addFilter( new QFilter_Set_Default( 'open', 'no' ) );
			$record -> process();

			try {
				$this -> getConnection() -> begin();

				$email -> insert();
				$schedule -> insert();

				$record -> update();
				$this -> getConnection() -> commit();

				return true;
			} catch( QDb_Exception $e ) { 
				$this -> getConnection() -> rollback();
				throw new QPage_Exception( $e -> getMessage() );
			}

			return false;
		}	

		/**
		 * Prepare SQL to query database for a number of records
		 *
		 * @param	$appointment			string
		 *
		 * @access			protected
		 * @introduced		2022/01/23 [last modified]
		 *
		 * @return			object typeof QDataspace_Interface
		 * @throws 			QDb_Exception
		 */
		 
		protected function queryDb( string $appointment ) : QDataspace_Interface { 
			try {
				$rs = $this -> fetch( 
					QDao_Statement::bindParams( $this -> getConnection(), 
						"select
							av.*
					   from appointments_visitors av 
					  where av.appointment = ?", 
						array(
							1	=>	$appointment
						) 
					)
				); 
				
				return new QParameters( $rs -> getRow() );
			} catch( QDb_Exception $e ) {
				throw new QDb_Exception( $e -> getMessage() );
			}
		}	
	}
	
?>