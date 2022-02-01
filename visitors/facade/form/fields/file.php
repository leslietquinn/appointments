<?php
	
	final class QVisitors_Facade_Form_Fields extends QDao implements QAcceptee_Interface {
		protected array $field_name;
		
		/**
		 * Class constructor
		 *
		 * @param	$field_name			array
		 *
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 *
		 * @return				void
		 */
		 
		public function __construct( array $field_name ) {
			$this -> field_name = $field_name;
		}
		
		/**
		 * Perform an operation and pass it onto $acceptable
		 *
		 * @param	$acceptable			object typeof QDataspace_Interface
		 *
		 * @see					QVisitors_Facade::formFields();
		 *
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 * @return				void
		 * @throws				QPage_Exception
		 */
		 
		public function push( $acceptable ) : void {
			if( !( $acceptable instanceof QDataspace_Interface or $acceptable instanceof QPage_Interface ) ) {
				throw new QPage_Exception( 'thrown exception: unsupported interface [./visitors/facade/form/fields] 36' );
			}
			
			$record = new QVisitors_Record( $acceptable -> get( 'id' ) );
			
			if( !$record -> has( 'id' ) ) {
				throw new QPage_Exception( 'thrown exception: invalid primary key given [./visitors/facade/form/fields] 42' );
			}
			
			foreach( $this -> field_name as $field ) {
				$acceptable -> set( $field, $record -> get( $field ) );
			}
		}
	}
	
?>