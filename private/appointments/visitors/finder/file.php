<?php

	final class QAppointments_Visitors_Finder extends QFinder {

		/**
		 * Class constructor
		 * 
		 * @access				public
		 * @introduced			2022-01-19 [build date]
		 * @return				void
		 */

		public function __construct() {
			parent::__construct( new QAppointments_Visitors_Statement() );
		}
		
		/**
		 * Return the name of $this class, formatted
		 * 
		 * @access				protected
		 * @introduced			2022-01-19 [build date]
		 * @return				string
		 */

		protected function getClassname() : string {
			return 'QAppointments_Visitors_Record';
		}
		
		/**
		 * Return one record only for primary key
		 *
		 * @param	$appointment				string [0-9]+
		 *
		 * @see		
		 *
		 * @access					public
		 * @introduced				2022-01-22 [last modified]
		 * @return					object typeof QRecord_Interface, QDataspace_Interface 
		 */
		 
		public function usingAppointment( string $appointment ) : QRecord_Interface {
			$rs = $this -> getConnection() -> query( 
				QDao_Statement::bindParams( 
					$this -> getConnection(), $this -> getStatement() -> loadUsingAppointmentStatement(), array(
						1 	=>	$appointment 
					)
				)
			);
			
			return $this -> loadOne( $rs );
		}

	}
	
?>