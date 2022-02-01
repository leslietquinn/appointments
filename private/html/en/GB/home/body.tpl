
				<br>
				<br>
				<br>
								
				<br>
				<br>
			
				<div class="viewarea">
					<a name="form_anchor" id="form_anchor"></a>
					<div class="middle">
						<div class="padding">
							<div class="viewarea">
								<div class="middle">
									<div class="viewarea with-border background corners">
										<br>
										<br>
										<div class="middle">
											<div class="viewarea">
												<h3>Log In Required</h3>
												<hr>
												<br>

												<form
													autocomplete="off" 
													method="post" 
													accept-charset="utf-8" 
													enctype="application/x-www-form-urlencoded" 
													action="<?php echo $this -> get( '__alternatebaseuri' ); ?>">
														
													<p>
														<label for="email"><span class="embolden">Username</span></label>
														<input class="corners" value="les.quinn.2012@gmail.com" type="text" name="email" id="email" placeholder="Use your email address">
													</p>
													<br>
													<br>
													
													<p>
														<label for="password"><span class="embolden">Password</span></label>
														<input class="corners" value="b5k46jy21utx" type="password" name="password" id="password" placeholder="Enter a password">
													</p>
													
													<p>
														<input type="submit" name="submit" value="Log In" class="corners">
														<input type="hidden" name="<?php echo QForm::TOKEN; ?>" value="<?php echo $this -> get( QForm::TOKEN ); ?>">
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
					<div class="clear"></div>
					
					<br>
				</div>
				<div class="clear"></div>
				
				<br>
