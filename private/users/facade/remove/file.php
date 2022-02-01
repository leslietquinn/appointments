<?php
	
	final class QUsers_Facade_Remove extends QDao implements QAcceptee_Interface {
		
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
		 * @see				QUsers_Facade::remove();
		 *
		 * @access			public
		 * @introduced		2022-01-19 [build date]
		 * @return			bool
		 * @throws			QPage_Exception
		 */
		 
		public function push( $acceptable ) : bool {
			if( !( $acceptable instanceof QDataspace_Interface or $acceptable instanceof QPage_Interface ) ) {
				throw new QPage_Exception( 'thrown exception: unsupported interface [./users/facade/remove] 30' );
			}
			
			$record = new QUsers_Record( $acceptable -> get( 'id' ) );
			
			if( !$record -> has( 'id' ) ) {
				throw new QPage_Exception( 'thrown exception: invalid primary key given [./users/facade/remove] 36' );
			}
			
			try {
				$this -> getConnection() -> begin();

				$record -> delete();
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