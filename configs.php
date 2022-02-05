<?php 

	$cfg = array (
  		'db' 		=> 	array (
    			'srce' 			=> 	'appointments',
    			'host' 			=> 	'localhost',
    			'user' 			=> 	'root',
    			'pass' 			=> 	'b5k46jy21utx',
				'type'			=> 	'mysql', 				
				
  				),
  		
		'session'	=>	array(
				// session ttl token
				'duration'		=>	QInterval::HOUR * 1,
				
				),
				
	);
	
?>