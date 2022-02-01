<?php

	final class QVisitors_Finder extends QFinder {

		/**
		 * Class constructor
		 * 
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 * @return				void
		 */

		public function __construct() {
			parent::__construct( new QVisitors_Statement() );
		}
		
		/**
		 * Return the name of $this class, formatted
		 * 
		 * @access				protected
		 * @introduced			2022-01-16 [build date]
		 * @return				string
		 */

		protected function getClassname() : string {
			return 'QVisitors_Record';
		}
		
		/**
		 * Return one or more records for form control
		 *
		 * @see		
		 *
		 * @access				public
		 * @introduced			2022-01-16 [build date]
		 * @return				array
		 */
		 
		public function selectAll() : array {
			$stmt = $this -> getConnection() -> createStatement( $this -> getStatement() -> loadSelectAllStatement() );
			
			$rs = $stmt -> execute();
			
			return $this -> loadAll( $rs, 'QVisitors_Record' );
		}

		/**
		 * Return one or more records ordered by timestamp with limit
		 *
		 * @param	$limitby			int
		 * 
		 * @see		
		 *
		 * @access			public
		 * @introduced		2022-01-16 [build date]
		 * @return			array
		 */
		 
		public function findAll( int $limitby ) : array {
			$stmt = $this -> getConnection() -> createStatement( $this -> getStatement() -> loadFindAllStatement() );
			
			$stmt -> setInteger( 1, $limitby );
			$rs = $stmt -> execute();
			
			return $this -> loadAll( $rs, 'QVisitors_Record' );
		}

		/**
		 * Return one record only for primary key
		 *
		 * @param	$id				string [0-9a-zA-Z]+
		 *
		 * @see		
		 *
		 * @access					public
		 * @introduced				2022-01-16 [build date]
		 * @return					object typeof QRecord_Interface, QDataspace_Interface 
		 */
		 
		public function usingId( string $id ) : QRecord_Interface {
			$stmt = $this -> getConnection() -> createStatement( $this -> getStatement() -> loadUsingIdStatement() );
			
			$stmt -> setString( 1, $id );
			$rs = $stmt -> execute();
			
			return $this -> loadOne( $rs, 'QVisitors_Record' );
		}

		/**
		 * Return one record only for unique hash
		 *
		 * @param	$hash				string 32 [0-9a-zA-Z]{32}
		 *
		 * @see		
		 *
		 * @access			public
		 * @introduced				2022-01-16 [build date]
		 * @return					object typeof QRecord_Interface, QDataspace_Interface 
		 */
		 
		public function usingHash( string $hash ) : QRecord_Interface {
			$stmt = $this -> getConnection() -> createStatement( $this -> getStatement() -> loadUsingHashStatement() );
			
			$stmt -> setString( 1, md5( $hash );
			$rs = $stmt -> execute();
			
			return $this -> loadOne( $rs, 'QVisitors_Record' );
		}

		
		/**
		 * Return one column only as defined found for primary key
		 *
		 * @see		
		 *
		 * @access			public
		 * @introduced		2022-01-16 [build date]
		 * @return			string		yes no
		 */
		 
		public function statusOnly() : string {
			$stmt = $this -> getConnection() -> createStatement( $this -> getStatement() -> loadStatusOnlyStatement() );
			
			$rs = $stmt -> execute();
			$row = $rs -> getRow();
			
			return $row['status'];
		}

		/**
		 * Return one record only for primary key
		 *
		 * @param	$email				string 
		 *
		 * @see		
		 *
		 * @access			public
		 * @introduced		2022-01-16 [build date]
		 * @return			object typeof QRecord_Interface, QDataspace_Interface 
		 */
		 
		public function usingEmail( string $email ) : QRecord_Interface {
			$stmt = $this -> getConnection() -> createStatement( $this -> getStatement() -> loadUsingEmailStatement() );
			
			$stmt -> setString( 1, $email );
			$rs = $stmt -> execute();
			
			return $this -> loadOne( $rs, 'QVisitors_Record' );
		}

		/**
		 * Return one record only for unique session passphrase
		 *
		 * @param	$passphrase				string [0-9a-zA-Z]{40}
		 *
		 * @see		
		 *
		 * @access			public
		 * @introduced		2022-01-16 [build date]
		 * @return			object typeof QRecord_Interface, QDataspace_Interface 
		 */
		 
		public function usingPassphrase( string $passphrase ) : QRecord_Interface {
			$stmt = $this -> getConnection() -> createStatement( $this -> getStatement() -> loadUsingPassphraseStatement() );
			
			$stmt -> setString( 1, $passphrase );
			$rs = $stmt -> execute();
			
			return $this -> loadOne( $rs, 'QVisitors_Record' );
		}

	}
	
?>