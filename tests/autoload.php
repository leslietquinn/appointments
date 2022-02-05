<?php 
	
	spl_autoload_register( '__autoloader__' );

	function __autoloader__( $classname ) {
		$app_dir = dirname( __DIR__ ).'/';
		$lib_dir = $app_dir.'library/core/';

		$classname = str_replace( '_', DIRECTORY_SEPARATOR, strtolower( $classname ) ).DIRECTORY_SEPARATOR.'file.php'; 
		$classname = substr( $classname, 1 );

		if( file_exists( $app_dir.$classname ) ) {
			require $app_dir.$classname;
			return;
		}

		if( file_exists( $lib_dir.$classname ) ) {
			require $lib_dir.$classname; 
			return;
		}
	}

?>