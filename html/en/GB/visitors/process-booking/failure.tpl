	
	<phptag:alerts />

	<h1>Booking a time Slot (<?php echo $this -> get( 'booking_date_format' ); ?>)</h1>
	<hr>
	<p>Choose an available time slot, followed by entering your details.</p>
	<br>

	<a name="form_anchor" id="form_anchor"></a>
	<div id="form_container" class="viewarea">
		<form
			id="form_control"
			autocomplete="off" 
			method="post" 
			accept-charset="utf-8" 
			enctype="application/x-www-form-urlencoded" 
			action="#">

			<p>
				<label for="slot"><span class="embolden">Available Slots</span></label>
				<select class="corners" name="slot" id="slot" size="5">
					<option value="0">- Slots -</option>

					<?php foreach( $this -> get( 'slot' ) as $option ): ?>
					<option value="<?php echo $option -> get( 'id' ); ?>" <?php if( $option -> get( 'ignore' ) == 'yes' ): ?>disabled="disabled"<?php endif; ?><?php echo $option -> get( 'selected' ); ?>><?php echo $option -> get( 'name' ); ?></option>
					<?php endforeach; ?>
				</select>
			</p>
			<p>Choose a time for your appointment.</p>
			<br>

			<p>
				<label for="fullname"><span class="embolden">Full Name</span></label>
				<input class="corners" type="text" name="fullname" id="fullname" value="<?php echo $this -> escape( $this -> get( 'fullname' ) ); ?>" placeholder="Enter your full name" />
			</p>
			<br>

			<p>
				<label for="email"><span class="embolden">Email Address</span></label>
				<input class="corners" type="text" name="email" id="email" value="<?php echo $this -> escape( $this -> get( 'email' ) ); ?>" placeholder="Enter your email address" />
			</p>
			<br>

			<p>
				<label for="telephone"><span class="embolden">Telephone</span></label>
				<input class="corners" type="text" name="telephone" id="telephone" value="<?php echo $this -> escape( $this -> get( 'telephone' ) ); ?>" placeholder="Enter your telephone number" />
			</p>
			<br>

			<p>
				<input id="form_button" class="corners" type="submit" name="submit" value="Complete Booking" />
				<input type="hidden" name="<?php echo QForm::TOKEN; ?>" value="<?php echo $this -> escape( $this -> get( QForm::TOKEN ) ); ?>" />
				<input type="hidden" name="__date__" value="<?php echo $this -> escape( $this -> get( '__date__' ) ); ?>" />
			</p>
		</form>
	</div>
