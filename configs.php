<?php 

	$cfg = array (
  		'db' 		=> 	array (
    			'srce' 			=> 	'appointments',
    			'host' 			=> 	'localhost',
    			'user' 			=> 	'root',
    			'pass' 			=> 	'',
				'type'			=> 	'mysql', 				
				
  				),
  		
		'session'	=>	array(
				// session ttl token
				'duration'		=>	QInterval::HOUR * 1,
				
				),
				
	);
	
?>