<?php
	
	final class QAppointments_Facade_Email_Automated extends QDao implements QAcceptee_Interface {
		protected QDao $decorated;

		/**
		 * Class constructor
		 *
		 * @param 	$decorated 			object typeof QDao
		 * 
		 * @access			public
		 * @introduced		2022-01-19 [build date]
		 * @return			void
		 */
		 
		public function __construct( QDao $decorated ) {
			$this -> decorated = $decorated;
		}
		
		/**
		 * Perform an operation and pass it onto $acceptable
		 *
		 * @param	$acceptable			object typeof QDataspace_Interface
		 *
		 * @see				QAppointments_Facade::automatedEmail();
		 * @see 			QDashboard::automateEmailVisitor();
		 *
		 * @access			public
		 * @introduced		2022-01-19 [build date]
		 * @return			bool
		 * @throws			QPage_Exception
		 */
		 
		public function push( $acceptable ) : bool {
			$filename = dirname( __FILE__ ).'/html.dat';

			/**
			 * @note 	an automated email has no input from UI so we create generic input 
			 * 			for an automated email sent to a visitor
			 */
			
			$acceptable -> addFilter( new QFilter_Set_Default( 'processor', 'send-automated-visitor-email' ) );
			$acceptable -> addFilter( new QFilter_Set_Default( 'subject', 'Re. Appointment (This is a confirmation)' ) );
			$acceptable -> addFilter( new QFilter_Set_Default( 'body', file_get_contents( $filename ) ) );
			$acceptable -> process();
			
			return $this -> decorated -> push( $acceptable );
		}	
	}
	
?>