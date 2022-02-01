<?php
	
	final class QAppointments_Facade_Change extends QDao implements QAcceptee_Interface {
		
		/**
		 * Class constructor
		 *
		 * @access			public
		 * @introduced		2022-01-19 [build date]
		 *
		 * @return			void
		 */
		 
		public function __construct() {}
		
		/**
		 * Perform an operation and pass it onto $acceptable
		 *
		 * @param	$acceptable			object typeof QDataspace_Interface
		 *
		 * @see					QAppointments_Facade::change();
		 *
		 * @access				public
		 * @introduced			2022-01-19 [build date]
		 *
		 * @return				bool
		 * @throws				QPage_Exception
		 */
		 
		public function push( $acceptable ) : bool {
			if( !( $acceptable instanceof QDataspace_Interface or $acceptable instanceof QPage_Interface ) ) {
				throw new QPage_Exception( 'thrown exception: unsupported interface [./appointments/facade/change] 32' );
			}
			
			$record = new QAppointments_Record( $acceptable -> get( 'id' ) );
			
			if( !$record -> has( 'id' ) ) {
				throw new QPage_Exception( 'thrown exception: invalid primary key given [./appointments/facade/change] 38' );
			}
			
			$record -> addFilter( new QFilter_Set_Default( 'confirmed', 'yes' ) );
			$record -> addFilter( new QFilter_Set_Default( 'open', 'no' ) );
			$record -> process();

			try {
				$this -> getConnection() -> begin();

				$record -> update();
				$this -> getConnection() -> commit();

				return true;
			} catch( QDb_Exception $e ) {
				$this -> getConnection() -> rollback();
				throw new QPage_Exception( $e -> getMessage() );
			}

			return false;
		}
		
	}
	
?>