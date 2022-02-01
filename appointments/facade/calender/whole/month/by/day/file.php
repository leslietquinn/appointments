<?php
	
	final class QAppointments_Facade_Calender_Whole_Month_By_Day extends QDao implements QAcceptee_Interface {
		protected string $field_name;
		protected int $adjustment;

		/**
		 * Class constructor
		 *
		 * @param	$field_name 		string
		 * @param	$adjustment			int
		 *
		 * @access			public
		 * @introduced		2022-01-17
		 *
		 * @return			void
		 */
		 
		public function __construct( string $field_name, int $adjustment ) {
			$this -> field_name = $field_name;
			$this -> adjustment = $adjustment;
		}
		
		/**
		 * Perform an operation and pass it onto $acceptable
		 *
		 * @param	$acceptable			object typeof QDataspace_Interface
		 *
		 * @see					QAppointments_Facade::calenderWholeMonthByDay();
		 *
		 * @access				public
		 * @introduced			2022-01-17
		 *
		 * @return				void
		 * @throws				QPage_Exception
		 */
		 
		public function push( $acceptable ) : void {
			if( !( $acceptable instanceof QDataspace_Interface or $acceptable instanceof QPage_Interface ) ) {
				throw new QPage_Exception( 'thrown exception: unsupported interface [app/appointments/facade/calender/whole/month/by/day] 40' );
			}
			
			try { 
				$appointment = new QAppointments();
				$month = $appointment -> adjustToMonth( date( 'm' ) + $this -> adjustment ); 

				/**
				 * @note 	have the flat array of a calender month, now need to include
				 * 			auxiliary information for each day
				 */

				$cells = $appointment -> calenderWholeMonthByDay( 
					date( 'Y-m-d', mktime( 0, 0, 0, $month, 1, date( 'Y' ) ) )
				);

				$days = array();
				foreach( $cells as $cell ) {
					$date = ( $cell == 0 )? date( 'Y-m-d', strtotime( 'yesterday' ) ):date( 'Y-m-d', mktime( 0, 0, 0, $month, $cell, date( 'Y' ) ) );

					$days[] = new QParameters(
						array(
							'day'			=>	$cell
						  , 'date'			=>	$date
						  ,	'slots'			=>	$this -> availableSlots( $date )
						  , 'past_date'		=>	$appointment -> determineIfInThePast( $date )
						  , 'is_weekend'	=>	$appointment -> isAWeekendDay( $date )
						)
					);
				}
				
				$acceptable -> import( 
					new QParameters(
						array(
							$this -> field_name => $days
						)
					)
				); 
			} catch( QAppointments_Exception $e ) {
				throw new QPage_Exception( $e -> getMessage() );
			}
		}
		
		/**
		 * Find number of time slots consumed for a given date
		 * 
		 * @param 	$date 			string
		 * 
		 * @access			protected
		 * @introduced 		2022/01/18
		 * @return			int
		 * @throws 			QDb_Exception
		 */
		 
		protected function availableSlots( string $date ) : int { 
			try {
				$rs = $this -> fetch( 
					QDao_Statement::bindParams( $this -> getConnection(), 
						"select
							count( ap.id ) as slots 
					   from appointments ap 
					  where ap.open = 'yes' 
					    and ap.session = ?;", 
						array(
							1	=>	$date
						) 
					)
				); 
				
				$row = $rs -> getRow();
				$count = array(
					0 	=>	8
				  , 1 	=>	7
				  , 2 	=>	6
				  , 3 	=>	5
				  , 4 	=>	4
				  , 5 	=>	3
				  , 6 	=>	2
				  , 7 	=>	1
				  , 8 	=>	0
				);

				return $count[$row['slots']];
			} catch( QDb_Exception $e ) {
				throw new QDb_Exception( $e -> getMessage() );
			}
		}
		
	}
	
?>