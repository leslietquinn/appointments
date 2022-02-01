	
	<br>
	<br>
	
	<div class="viewarea">
		<h1 class="center">Dashboard</h1>
		
		<br>
		<br>
		<br>

		<!----------------------------------------------------->
		<!---- Appointments ----------------------------------->
		
		<phptag:appointments />

	</div>
	<div class="clear"></div>
	
	<br>
	<br>

	<script type="text/javascript" nonce="<?php echo $this -> get( '__nonce' ); ?>">
	
		$( '#search_input_appointments_open_dashboard' ).keyup( function() {
			var val = $( '#search_input_appointments_open_dashboard' ).val(); 
			
			$.get( '<?php echo $this -> get( '__alternatebaseuri' ); ?>ajax/search-appointments-open/?s=' + encodeURIComponent( val ), function( rs, status, xhr ) {
				$( '#select_options_appointments_open_dashboard' ).html( rs );
			});
		});
				
		$( '#search_input_appointments_confirmed_dashboard' ).keyup( function() {
			var val = $( '#search_input_appointments_confirmed_dashboard' ).val(); 
			
			$.get( '<?php echo $this -> get( '__alternatebaseuri' ); ?>ajax/search-appointments-confirmed/?s=' + encodeURIComponent( val ), function( rs, status, xhr ) {
				$( '#select_options_appointments_confirmed_dashboard' ).html( rs );
			});
		});
				
	</script>
