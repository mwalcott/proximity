<div class="row our-clients content-row">
	<div class="col-sm-12">
		<h1>
			<?php 
				$heading = get_sub_field('cb_heading');
				if($heading) {
					echo $heading;
				}
			?>
		</h1>
		<?php the_sub_field('cb_description'); ?>
	</div>
</div>
