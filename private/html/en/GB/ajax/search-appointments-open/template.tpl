					
					<?php if( $this -> has( 'open' ) ): ?>
					<select name="dashboard" id="open" size="<?php echo QAppointments::MENU_SIZE; ?>" class="corners">
						<option value="0" selected="selected">- Select a Record -</option>
						
						<?php foreach( $this -> get( 'open' ) as $option ): ?>
							<option value="<?php echo $this -> escape( $option -> get( 'id' ) ); ?>" title="<?php echo $this -> escape( $option -> get( 'alternate_slot' ) ); ?>&nbsp;<?php echo $this -> escape( $option -> get( 'session' ) ); ?>&nbsp;<?php if( $option -> get( 'rescheduled' ) == 'yes' ): ?>(Rescheduled)&nbsp;<?php endif; ?><?php echo $this -> escape( $option -> get( 'fullname' ) ); ?>&nbsp;<?php echo $this -> escape( $option -> get( 'email' ) ); ?>&nbsp;<?php echo $this -> escape( $option -> get( 'telephone' ) ); ?>"><?php echo $this -> escape( $option -> get( 'alternate_slot' ) ); ?>&nbsp;<?php echo $this -> escape( $option -> get( 'session' ) ); ?>&nbsp;<?php if( $option -> get( 'rescheduled' ) == 'yes' ): ?>(Rescheduled)&nbsp;<?php endif; ?><?php echo $this -> escape( $option -> get( 'fullname' ) ); ?>&nbsp;<?php echo $this -> escape( $option -> get( 'email' ) ); ?>&nbsp;<?php echo $this -> escape( $option -> get( 'telephone' ) ); ?></option>
						<?php endforeach; ?>
					</select><select name="options" class="corners">
						<option value="0" selected="selected">- Select an Option -</option>
						<option value="confirmappointment">- Confirm Appointment -</option>
						<option value="emailvisitor">- Email Visitor -</option>
					</select><input type="submit" name="submit" value="Go" class="corners" />
					<?php else: ?>
					<select name="dashboard" id="open" size="<?php echo QAppointments::MENU_SIZE; ?>" class="corners">
						<option value="0" selected="selected">- Select a Record -</option>
					</select><select name="options" disabled="disabled" class="corners">
						<option value="0" selected="selected">- Select an Option -</option>
					</select><input type="submit" name="submit" value="Go" disabled="disabled" class="corners" />
					<?php endif; ?>
					<input type="hidden" name="<?php echo QForm::TOKEN; ?>" value="<?php echo $this -> escape( $this -> get( QForm::TOKEN ) ); ?>" />