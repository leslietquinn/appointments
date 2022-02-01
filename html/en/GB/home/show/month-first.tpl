	
	<h2 class="center"><?php echo $this -> escape( $this -> get( 'first' ) ); ?></h2>
	<hr>
	<br>
	<div class="viewarea">
		<div class="calendercell"><p class="center">Mo</p></div>
		<div class="calendercell"><p class="center">Tu</p></div>
		<div class="calendercell"><p class="center">We</p></div>
		<div class="calendercell"><p class="center">Th</p></div>
		<div class="calendercell"><p class="center">Fr</p></div>
		<div class="calendercell"><p class="center">Sa</p></div>
		<div class="calendercell"><p class="center">Su</p></div>
	</div>
	<div class="clear"></div>
	<br>
	<div class="viewarea">
		<div class="row">
		<?php $count = 0; foreach( $this -> get( 'first-calender' ) as $cell ): ?>
		<?php if( $count % 7 == 0 ): ?>
		</div><div class="calenderrow">
		<?php endif; ?>
		<?php if( $cell -> get( 'day' ) == 0 ): ?>
		<div class="calendercell calenderempty"><p>&nbsp;</p></div>
		<?php else: ?>
			<?php if( $cell -> get( 'past_date' ) == 'yes' ): ?>
				<div class="calendercell calenderpastdate"><!--
					--><p class="center">&nbsp;</p><!--
				--></div>
			<?php else: ?>
				<?php if( $cell -> get( 'slots' ) == 0 ): ?>
				<div class="calendercell calendervoid"><!--
					--><p class="center"><!--
						--><span class="tip" title="No time slots available, sorry"><?php echo $this -> escape( $cell -> get( 'day' ) ); ?></span><!-- 
					--></p><!--
				--></div>
				<?php else: ?>

					<?php if( $cell -> get( 'is_weekend' ) == 'yes' ): ?>
					<div class="calendercell calenderweekend"><!--
						--><p class="center"><!--
							--><span class="tip" title="Sorry, available Monday to Friday only"><?php echo $this -> escape( $cell -> get( 'day' ) ); ?></span><!-- 
						--></p><!--
					--></div>
					<?php else: ?>
					<div class="calendercell calenderoccupied"><!--
						--><p class="center"><!--
							--><span class="tip" title="<?php echo $this -> escape( $cell -> get( 'slots' ) ); ?> time slots available"><a class="nodeco embolden calenderday" rel="noindex,nofollow" href="/<?php echo $this -> escape( $cell -> get( 'date' ) ); ?>"><?php echo $this -> escape( $cell -> get( 'day' ) ); ?></a></span><!-- 
						--></p><!--
					--></div>
					<?php endif; ?>

				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>
		<?php $count++; endforeach; ?>
		</div>
	</div>
	<br>

