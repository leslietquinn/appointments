
	<br>
	<br>
	<br>
	<div class="viewarea">
		<div class="padding">
			<div class="viewarea">
				<div class="middle">
					<div class="viewarea">
						<div class="viewarea success corners">	
							<div class="middle">
								<br>
								<p class="center">Great! Your appointment has been successfully booked</p>
								<br>
							</div>
						</div>
					</div>
					<div class="clear"></div>

					<h1>Booking (#<?php echo $this -> escape( $this -> get( 'appointment' ) -> get( 'id' ) ); ?>)</h1>
					<hr>
					<p>Your appointment booking has been scheduled, pending our confirmation.</p>
					<br>
					<br>
					<div class="viewarea">
						<div class="middle">
							<h3>A confirmation email will be sent to acknowledge your appointment booking. If there is a problem we will attempt to call you in person.</h3>
						</div>
					</div>
					<div class="clear"></div>
					<br>
					<br>
					<hr>
					<p><!--
						--><a class="embolden" rel="index,follow" href="<?php echo $this -> get( '__baseuri' ); ?>appointments/reschedule/<?php echo $this -> escape( $this -> get( 'appointment' ) -> get( 'id' ) ); ?>/">Reschedule this appointment.</a><!--
					--></p>
				</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	
	<br>
	<br>
	<br>
	
	<script nonce="<?php echo $this -> get( '__nonce' ); ?>">

	</script>
