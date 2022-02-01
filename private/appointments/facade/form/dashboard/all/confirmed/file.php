<?php
	
	final class QAppointments_Facade_Form_Dashboard_All_Confirmed extends QForm_Select_Control implements QAcceptee_Interface {
		protected $field_name;
		
		/**
		 * Class constructor
		 *
		 * @param	$field_name			string
		 *
		 * @access			public
		 * @introduced		2022/01/21
		 *
		 * @return			void
		 */
		 
		public function __construct( string $field_name ) {
			$this -> field_name = $field_name;
			parent::__construct( 'id' );
		}
		
		/**
		 * Prepare and return a data set suitable for a form control
		 *
		 * @access			public
		 * @introduced		2022/01/21
		 *
		 * @return			array
		 * @throws			QPage_Exception
		 */
		
		protected function toArray() : array {
			$conn = QRegistry::get( 'connection' );
			$search = $this -> getSearch();

			/**
			 * @note	need to be sure there is a search term before we query the database
			 */

			if( !empty( $search ) ) {
				try {
					$rs = $conn -> query( $sql = QDao_Statement::bindParams( $conn,
						"select  
							ap.id 
						  , ap.slot
						  , ap.session 
						  , ap.rescheduled
						  , vi.email
						  , vi.fullname
						  , vi.telephone
					   from appointments ap 
				  left join appointments_visitors av on av.appointment = ap.id 
				  left join visitors vi on vi.id = av.visitor 
					  where ap.confirmed = 'yes' 
					    and ap.open = 'no' 
						and concat_ws( ' ', ap.slot, ap.session, vi.email, vi.fullname, vi.telephone ) regexp ? 
				   order by ap.session asc;",
							array(
								1 	=>	$search 
							)
						)
					);
					
					$rows = array();
					while( $row = $rs -> getRow() ) {
						$rows[] = $this -> runFilters( new QParameters( $row ) );
					}
					
					return $rows;
				} catch( QDb_Exception $e ) {
					throw new QPage_Exception( $e -> getMessage() );
				}
			} else {

				/**
				 * @note	there are no search terms, so return an empty array
				 */

				return array();
			}
		}

		/**
		 * Process one or more filters on the data supplied
		 *
		 * @param	$dataspace			object typeof QDataspace_Interface
		 *
		 * @access			protected
		 * @introduced		2022/01/21
		 *
		 * @return			object typeof QDataspace_Interface
		 */
		 
		protected function runFilters( QDataspace_Interface $dataspace ) : QDataspace_Interface {
			$dataspace -> addFilter( new QAppointments_Filter_Slots( 'slot', 'alternate_slot' ) );
			$dataspace -> process();

			return $dataspace;
		}
		
		/**
		 * Return the search terms, from $request
		 * 
		 * @access				protected
		 * @introduced			2022/01/21
		 * 
		 * @return				string
		 */

		protected function getSearch() : string {
			return QRegistry::get( 'request' ) -> get( 's' );
		}
	}
	
?>