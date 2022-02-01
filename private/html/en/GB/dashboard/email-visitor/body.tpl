				
				<br>
				<br>
				
				<div class="viewarea">
					<h1 class="center">Email Visitor</h1>
					
					<br>
					<br>
					<br>

					<div class="padding">
						<div class="viewarea">
							<div class="middle">
								<div class="viewarea with-border background corners">
									<div class="padding">

										<br>
										<br>
										<div class="middle">
											<div id="form_container" class="viewarea">
												
												<form
													id="form_control"
													autocomplete="off" 
													method="post" 
													accept-charset="utf-8" 
													enctype="application/x-www-form-urlencoded" 
													action="#">
													
													<p>
														<label for="subject"><span class="embolden">Subject</span></label>
														<input class="corners" value="Re. Appointment (<?php echo $this -> escape( $this -> get( 'appointment' ) -> get( 'alternate_slot' ) ); ?>, <?php echo $this -> escape( $this -> get( 'appointment' ) -> get( 'session' ) ); ?>)" type="text" name="subject" id="subject" placeholder="Enter a subject line">
													</p>
													<br>
													<br>
													
													<p>
														<label for="body"><span class="embolden">Message</span></label>
														<textarea class="corners" cols="48" rows="12" name="body" id="body" placeholder="Enter your message"></textarea>
													</p>
													
													<p>
														<input type="submit" name="submit" id="form_button" value="Send Email" class="corners">
														<input type="hidden" name="<?php echo QForm::TOKEN; ?>" value="<?php echo $this -> escape( $this -> get( QForm::TOKEN ) ); ?>">
														<input type="hidden" name="<?php echo QForm::ID; ?>" value="<?php echo $this -> escape( $this -> get( 'id' ) ); ?>">
													</p>
												</form>
											</div>
										</div>
										<div class="clear"></div>
										<br>
										<br>

									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
				<div class="clear"></div>
				
				<br>
				<br>

				<script type="text/javascript" nonce="<?php echo $this -> get( '__nonce' ); ?>">
				
					$( document ).on( 'submit', '#form_control', function( e ) {
						e.preventDefault();
							
						var data = $( this ).serialize(); 
						$( '#form_button' ).val( 'One moment...' );
							
						$.post( '<?php echo $this -> get( '__alternatebaseuri' ); ?>dashboard/process-email-visitor/', data, function( rs, status, xhr ) {
							if( rs == '__REDIRECT__' ) { 
								window.location.href = '<?php echo $this -> get( '__alternatebaseuri' ); ?>dashboard/';
							} else { 
								$( '#form_container' ).html( rs );
								
							}
						});
					});

				</script>
