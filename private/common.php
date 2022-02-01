<?php 

	$display_errors = true; 
	
	$directories = array(
		dirname( __FILE__ ).'/',
		
		// application templates
		dirname( __FILE__ ).'/html/',
		
		// application level
		dirname( dirname( __FILE__ ) ).'/shared/', 
		dirname( dirname( __FILE__ ) ).'/library/core/',  
	);
	
	$pathname = ini_get( 'include_path' );
	foreach( $directories as $directory ) {
		$pathname .= PATH_SEPARATOR.$directory;
	}
		
	// added on 02/05/2021
	if( strtoupper( substr( PHP_OS, 0, 3 ) ) === 'WIN' ) {          
		define( 'DIR_SEP', "\\" );
	} else { 
		define( 'DIR_SEP', "/" );
	}	
	
	spl_autoload_register( '__autoload__' );
	
	ini_set( 'include_path', $pathname );
	ini_set( 'display_errors', $display_errors );
	ini_set( 'display_startup_errors', $display_errors );
	ini_set( 'log_errors', 0 );
	
	ini_set( 'date.timezone', 'Europe/London' );
	ini_set( 'error_log', dirname( __FILE__ ).'/logs/errors.dat' ); 
	ini_set( 'mbstring.substitute_character', 'none' );
	
	ini_set( 'session.cookie_path', '/' );
	ini_set( 'session.cookie_httponly', 'off' ); 
	ini_set( 'session.auto_start', false ); 
	
	ini_set( 'session.use_cookies', true ); 
	ini_set( 'session.use_only_cookies', true );
	
	/**
	 * @note	15/07/2021
	 *
	 *			must be false for http and true for https 
	 *			otherwise session is lost on each page load 
	 *			creating a new session each time
	 *
	 * @see		https://stackoverflow.com/questions/33492889/session-start-creates-new-session-every-refresh-no-warning
	 */
	 
	ini_set( 'session.cookie_secure', false ); 
	
	ini_set( 'session.cache_expire', 180 ); 
	ini_set( 'session.gc_probability', 1 ); 
	ini_set( 'session.sid_length', 32 );
	
	ini_set( 'session.cookie_samesite', 'Strict' ); 
	ini_set( 'session.use_strict_mode', true );
	
	// do not use $_SESSION in the url
	ini_set( 'session.use_trans_sid', false ); 
	
	ini_set( 'session.save_handler', 'files' ); 
	ini_set( 'session.save_path', dirname( __FILE__ ).'/tmp/' );
	ini_set( 'session.cookie_lifetime', QInterval::HOUR * 24 );
	ini_set( 'session.gc_maxlifetime', QInterval::HOUR * 24 ); 
	
	// development only, allocate unlimited memory 
	ini_set( 'memory_limit', '-1' );
		
	// development only
	set_time_limit( 0 );
	
	mb_internal_encoding( 'UTF-8' );
	date_default_timezone_set( 'UTC' );
	
	function __autoload__( $classname ) { 
		if( !preg_match( '/Stripe/', $classname ) ) {
			$classname = str_replace( '_', DIRECTORY_SEPARATOR, $classname = strtolower( $classname ) ).DIRECTORY_SEPARATOR.'file.php'; 
		
			include_once( substr( $classname, 1 ) );
		} 
	}
	
	$router = new QHttp_Request_Uri_Route_Manager();

	$router -> addRoute( new QHttp_Request_Uri_Route( ':controller/:action', array( 'lang' => 'en-GB', 'controller' => 'home', 'action' => 'show', 'id' => null ), array( 'lang' => '([a-z]{2})\-([A-Z]{2})', 'controller' => '[a-z\-]+', 'action' => '[a-z\-]+', 'id' => '[a-zA-Z0-9\-]+' ) ) );
	$router -> addRoute( new QHttp_Request_Uri_Route( ':controller/:action/:id', array( 'lang' => 'en-GB', 'controller' => 'home', 'action' => 'show', 'id' => null ), array( 'lang' => '([a-z]{2})\-([A-Z]{2})', 'controller' => '[a-z\-]+', 'action' => '[a-z\-]+', 'id' => '[a-zA-Z0-9\-]+' ) ) );

	$router -> addRoute( new QHttp_Request_Uri_Route( 'home', array( 'lang' => 'en-GB', 'controller' => 'home', 'action' => 'show', 'id' => null ), array( 'lang' => '([a-z]{2})\-([A-Z]{2})', 'controller' => '[a-z\-]+', 'action' => '[a-z\-]+', 'id' => '[a-zA-Z0-9\-]+' ) ) );

	$router -> addRoute( new QHttp_Request_Uri_Route( 'logout', array( 'lang' => 'en-GB', 'controller' => 'logout', 'action' => 'show', 'id' => null ), array( 'lang' => '([a-z]{2})\-([A-Z]{2})', 'controller' => '[a-z\-]+', 'action' => '[a-z\-]+', 'id' => '[a-zA-Z0-9\-]+' ) ) );
	$router -> addRoute( new QHttp_Request_Uri_Route( 'dashboard', array( 'lang' => 'en-GB', 'controller' => 'dashboard', 'action' => 'show', 'id' => null ), array( 'lang' => '([a-z]{2})\-([A-Z]{2})', 'controller' => '[a-z\-]+', 'action' => '[a-z\-]+', 'id' => '[a-zA-Z0-9\-]+' ) ) );
	$router -> addRoute( new QHttp_Request_Uri_Route( 'dashboard/process-options', 
		array( 'lang' => 'en-GB', 'controller' => 'dashboard', 'action' => 'process-options', 'id' => null ), 
		array( 'lang' => '([a-z]{2})\-([A-Z]{2})', 'controller' => '[a-z\-]+', 'action' => '[a-z\-]+', 'id' => '[a-zA-Z0-9\-]+' ) ) );
	$router -> addRoute( new QHttp_Request_Uri_Route( 'dashboard/process-dashboard', 
		array( 'lang' => 'en-GB', 'controller' => 'dashboard', 'action' => 'process-dashboard', 'id' => null ), 
		array( 'lang' => '([a-z]{2})\-([A-Z]{2})', 'controller' => '[a-z\-]+', 'action' => '[a-z\-]+', 'id' => '[a-zA-Z0-9\-]+' ) ) );
	
	$router -> addRoute( new QHttp_Request_Uri_Route( 'dashboard/confirm-appointment/:id', 
		array( 'lang' => 'en-GB', 'controller' => 'dashboard', 'action' => 'confirm-appointment', 'id' => null ), 
		array( 'lang' => '([a-z]{2})\-([A-Z]{2})', 'controller' => '[a-z\-]+', 'action' => '[a-z\-]+', 'id' => '[a-zA-Z0-9\-]+' ) ) );
	
	$router -> addRoute( new QHttp_Request_Uri_Route( 'dashboard/email-visitor/:id', 
		array( 'lang' => 'en-GB', 'controller' => 'dashboard', 'action' => 'email-visitor', 'id' => null ), 
		array( 'lang' => '([a-z]{2})\-([A-Z]{2})', 'controller' => '[a-z\-]+', 'action' => '[a-z\-]+', 'id' => '[a-zA-Z0-9\-]+' ) ) );
	$router -> addRoute( new QHttp_Request_Uri_Route( 'dashboard/process-email-visitor', 
		array( 'lang' => 'en-GB', 'controller' => 'dashboard', 'action' => 'process-email-visitor', 'id' => null ), 
		array( 'lang' => '([a-z]{2})\-([A-Z]{2})', 'controller' => '[a-z\-]+', 'action' => '[a-z\-]+', 'id' => '[a-zA-Z0-9\-]+' ) ) );

	$router -> addRoute( new QHttp_Request_Uri_Route( 'dashboard/automate-email-visitor/:id', 
		array( 'lang' => 'en-GB', 'controller' => 'dashboard', 'action' => 'automate-email-visitor', 'id' => null ), 
		array( 'lang' => '([a-z]{2})\-([A-Z]{2})', 'controller' => '[a-z\-]+', 'action' => '[a-z\-]+', 'id' => '[a-zA-Z0-9\-]+' ) ) );

	/********************************************************************************************************************/
	/********************************************************************************************************************/
	/*																													*/
	/*		Ajax 																										*/
	/*																													*/
	/********************************************************************************************************************/
	/********************************************************************************************************************/
	
	$router -> addRoute( new QHttp_Request_Uri_Route( 'ajax/search-appointments-open', 
		array( 'lang' => 'en-GB', 'controller' => 'ajax', 'action' => 'search-appointments-open', 'id' => null ), 
		array( 'lang' => '([a-z]{2})\-([A-Z]{2})', 'controller' => '[a-z\-]+', 'action' => '[a-z\-]+', 'id' => '[a-zA-Z0-9\-]+' ) ) );
	$router -> addRoute( new QHttp_Request_Uri_Route( 'ajax/search-appointments-confirmed', 
		array( 'lang' => 'en-GB', 'controller' => 'ajax', 'action' => 'search-appointments-confirmed', 'id' => null ), 
		array( 'lang' => '([a-z]{2})\-([A-Z]{2})', 'controller' => '[a-z\-]+', 'action' => '[a-z\-]+', 'id' => '[a-zA-Z0-9\-]+' ) ) );

	include_once( 'configs.php' ); 
	
	QRegistry::set( 'configuration', new QParameters( $cfg ) );
	QRegistry::set( 'request', $request = new QHttp_Request() );
	
	QRegistry::set( 'connection', $connection = QDb::factory( 
			array(
				$cfg['db']['srce'],
				$cfg['db']['host'],
				$cfg['db']['user'],
				$cfg['db']['pass'] 
			), 'mysqli' 
		)
	); 
	
	QRegistry::set( 'logger', new QLogger( new QLogger_File( $logs = dirname( __FILE__ ).'/logs/logs.dat' ) ) );
	QRegistry::set( 'cache_directory', dirname( __FILE__ ).'/cache/' );
	QRegistry::set( 'is_localhost', $display_errors ); 

	// @note need to remove one dirname( ... ) from here on live server
	QRegistry::set( '__protected', $protected = dirname( __FILE__ ).'/' );

	// use $_SERVER['DOCUMENT_ROOT'].'/'; on live server
	QRegistry::set( '__public', $public = dirname( dirname( dirname( dirname( __FILE__ ) ) ) ).'/app/' );
		
	if( $display_errors ) {
		$connection -> setLogger( 
			new QLogger( new QLogger_File( $protected.'logs/sql.dat' ) ) 
		);
	}
			
	// set default logging for uncaught exceptions
	set_exception_handler(
		function( $e ) {
			file_put_contents( dirname( __FILE__ ).'/logs/logs.dat', $e -> __toString(), FILE_APPEND );
		} 
	);

	function error_reporter( $error_number, $error_string, $error_file, $error_line ) {
		echo( '<pre>' ); 
		echo $error_number.'<br>'.$error_string.'<br>'.$error_file.'<br>'.$error_line;
		echo( '</pre>' );
	}
	
	set_error_handler( 'error_reporter', E_ALL );

	if( !session_id() === null ) {
		session_destroy();
	}
	
	session_start();
	
	$request -> addFilter( $router ); 
	$request -> set( 'session', new QHttp_Session() ); 
	
	// quick fix to replace encode characters from ajax requests
	$_SERVER['REQUEST_URI'] = str_replace( '%C2%A0', '', $_SERVER['REQUEST_URI'] );
	
	$request -> addFilter( new QHttp_Request_Utility_I18n() );
	$request -> addFilter( new QFilter_Set_Default( '__administrator', QCommon::ADMINISTRATOR ) );
	$request -> addFilter( new QFilter_String_Obfuscate_Email( '__administrator' ) );
	$request -> process();
	
	$request -> addFilter( new QHttp_Request_Security_Hash( '__hash__' ) );
	$request -> addFilter( new QHttp_Request_Uri_Query_String( '__querystring' ) );
	$request -> addFilter( new QHttp_Request_Uri_Preserve( '__uri' ) );
	$request -> addFilter( new QHttp_Request_Uri_Ip_Address() );
	$request -> addFilter( new QHttp_Request_Uri_Referer() );
	$request -> addFilter( new QHttp_Request_Uri_UA() );		
	$request -> addFilter( new QHttp_Request_Uri( '__requesturi' ) );
	$request -> addFilter( new QHttp_Request_Uri_Ajax_Sanitise( '&' ) );
	$request -> addFilter( new QHttp_Request_Utility_Is_Mobile( '__mobile' ) );
	$request -> addFilter( new QHttp_Request_Session_Destroy( QCommon::SESSION_TTL ) );
	$request -> process(); 
	
	$request -> addFilter( new QFilter_Random( '__nonce', 40, 'unique' ) );
	$request -> process();
	
	$request -> set( '__year', date( 'Y' ) ); 
	$request -> set( '__date', date( 'D dS M Y' ) ); 
	
	$request -> set( '__baseuri', 'http://www.app.com/' );
	$request -> set( '__alternatebaseuri', 'http://www.private.app.com/' );
	
?>