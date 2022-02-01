<?php 

	$cfg = array (
  		'db' 		=> 	array (
    			'srce' 			=> 	'appointments',
    			'host' 			=> 	'localhost',
    			'user' 			=> 	'root',
    			'pass' 			=> 	'b5k46jy21utx',
				'type'			=> 	'mysql', 				
				
  				),
		
		'login'		=>	array(
				// signed in for period of 10 minutes
				'duration'		=>	600,
				
				),
		
		'session'	=>	array(
				// session ttl token
				'duration'		=>	QInterval::HOUR * 1,
				
				),
				
	);
	
?>