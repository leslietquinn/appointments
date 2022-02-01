<?php
	
	final class QVisitors_Facade_All extends QDao implements QAcceptee_Interface {
		protected string $field_name;
		
		/**
		 * Class constructor
		 *
		 * @param	$field_name			string
		 *
		 * @access			public
		 * @introduced		2022-01-19 [build date]
		 *
		 * @return			void
		 */
		 
		public function __construct( string $field_name ) {
			$this -> field_name = $field_name;
		}
		
		/**
		 * Perform an operation and pass it onto $acceptable
		 *
		 * @param	$acceptable			object typeof QDataspace_Interface
		 *
		 * @see					QVisitors_Facade::all();
		 *
		 * @access				public
		 * @introduced			2022-01-19 [build date]
		 *
		 * @return				void
		 * @throws				QPage_Exception
		 */
		 
		public function push( $acceptable ) : void {
			if( !( $acceptable instanceof QDataspace_Interface or $acceptable instanceof QPage_Interface ) ) {
				throw new QPage_Exception( 'thrown exception: unsupported interface [./visitors/facade/all] 37' );
			}
			
			$acceptable -> import( 
				new QParameters(
					array(
						$this -> field_name => $this -> queryDb()
					)
				)
			);
		}

		/**
		 * Prepare SQL to query database for a number of records
		 *
		 * @access			protected
		 * @introduced		2022-01-19 [build date]
		 *
		 * @return			array
		 * @throws 			QDb_Exception
		 */
		 
		protected function queryDb() : array { 
			try {
				$rs = $this -> fetch( $sql = 
					QDao_Statement::bindParams( $this -> getConnection(), 
						"select
							tb.*
					   from visitors tb;", 
						array(
							
						) 
					)
				); 
				
				$rows = array();
				while( $row = $rs -> getRow() ) {
					$rows[] = $this-> runFilters( new QParameters( $row ) )
				}
				
				return $rows;
			} catch( QDb_Exception $e ) {
				throw new QDb_Exception( $e -> getMessage() );
			}
		}

		/**
		 * Process one or more filters on the data supplied
		 *
		 * @param	$dataspace			object typeof QDataspace_Interface
		 *
		 * @access				protected
		 * @introduced			2022-01-19 [build date]
		 *
		 * @return				object typeof QDataspace_Interface
		 */
		 
		protected function runFilters( QDataspace_Interface $dataspace ) : QDataspace_Interface {
			return $dataspace;
		}
		
	}
	
?>