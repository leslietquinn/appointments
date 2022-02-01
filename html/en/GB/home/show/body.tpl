	
	<br>
	<br>
	<br>
	<div class="viewarea">
		<div class="padding">
			<div class="viewarea">
				<div id="hinge" class="middle">
					<h1>Appointments</h1>
					<hr>
					<p>Book your appointment, available dates are shown below. Consultations are one hour only.</p>
					<br>
					<div class="thirty3">
						<phptag:month-first />
					</div>
					<div class="thirty3">
						<phptag:month-second />
					</div>
					<div class="thirty3">
						<phptag:month-third />
					</div>
					<div class="clear"></div>
					<br>
					<hr>					
				</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	
	<br>
	<br>
	<br>
	
	<script nonce="<?php echo $this -> get( '__nonce' ); ?>">

		$( document ).ready( function() {
			$( '.calenderday' ).click( function( e ) {
				e.preventDefault();

				var date = $( this ).attr( 'href' ).split( '/' )[1]; 

				$( '#hinge' ).load( '<?php echo $this -> get( '__baseuri' ); ?>visitors/book-appointment/' + date + '/' );
				$( '.tooltip' ).remove();
			});
		});

		$( document ).on( 'submit', '#form_control', function( e ) {
			e.preventDefault();
				
			var data = $( this ).serialize(); 
			$( '#form_button' ).val( 'One moment...' );
				
			$.post( '<?php echo $this -> get( '__baseuri' ); ?>visitors/process-booking/', data, function( rs, status, xhr ) {
				if( rs == '__REDIRECT__' ) { 
					window.location.href = '<?php echo $this -> get( '__baseuri' ); ?>appointments/booking-complete/';
				} else { 
					$( '#container' ).html( rs );
					
				}
			});
		});
		
	</script>
