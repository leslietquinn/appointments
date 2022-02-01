		
		<br>
		<h2>Appointments (Open)</h2>
		<hr>
		<br>

		<form 
			autocomplete="off" 
			method="post" 
			accept-charset="utf-8"
			enctype="application/x-www-form-urlencoded" 
			action="<?php echo $this -> get( '__alternatebaseuri' ); ?>dashboard/process-dashboard/"> 

			<p>
				<input type="text" name="search_input_appointments_open_dashboard" id="search_input_appointments_open_dashboard" value="" placeholder="Search using... a date or a name, an email address or telephone number" class="corners" />
				<div id="select_options_appointments_open_dashboard">
					<select name="dashboard" id="default" size="<?php echo QAppointments::MENU_SIZE; ?>" class="corners">
						<option value="0" selected="selected">- Select a Record -</option>
					</select><select name="options" disabled="disabled" class="corners">
						<option value="0" selected="selected">- Select an Option -</option>
					</select><input type="submit" name="submit" value="Go" disabled="disabled" class="corners" />
					<input type="hidden" name="<?php echo QForm::TOKEN; ?>" value="<?php echo $this -> escape( $this -> get( QForm::TOKEN ) ); ?>" />
				</div>
			</p>
			<p><span>Select a record followed by an option</span></p>
		</form>
		<br>