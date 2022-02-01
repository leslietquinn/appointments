
												<phptag:alerts />

												<form
													id="form_control"
													autocomplete="off" 
													method="post" 
													accept-charset="utf-8" 
													enctype="application/x-www-form-urlencoded" 
													action="#">
														
													<p>
														<label for="subject"><span class="embolden">Subject</span></label>
														<input <?php if( $this -> get( 'logger' ) -> has( 'subject' ) ): ?>class="error corners"<?php else: ?>class="corners"<?php endif; ?> value="<?php echo $this -> escape( $this -> get( 'subject' ) ); ?>" type="text" name="subject" id="subject" placeholder="Enter a subject line">
													</p>
													<br>
													<br>
													
													<p>
														<label for="body"><span class="embolden">Message</span></label>
														<textarea <?php if( $this -> get( 'logger' ) -> has( 'body' ) ): ?>class="error corners"<?php else: ?>class="corners"<?php endif; ?> cols="48" rows="12" name="body" id="body" placeholder="Enter your message"><?php echo $this -> escape( $this -> get( 'body' ) ); ?></textarea>
													</p>
													
													<p>
														<input type="submit" name="submit" id="form_button" value="Send Email" class="corners">
														<input type="hidden" name="<?php echo QForm::TOKEN; ?>" value="<?php echo $this -> escape( $this -> get( QForm::TOKEN ) ); ?>">
														<input type="hidden" name="<?php echo QForm::ID; ?>" value="<?php echo $this -> escape( $this -> get( 'id' ) ); ?>">
													</p>
												</form>