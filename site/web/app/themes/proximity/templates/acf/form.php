<?php 
	$background = get_sub_field('form_background_image');
	$image = '';
	if($background) {
		$image = 'style="background-image: url('. $background .');"';	
	}
?>
<div class="row form-wrapper content-row" <?php echo $image; ?>>
	<div class="col-sm-6 offset-sm-3">
		<?php the_sub_field('form_block'); ?>
	</div>
</div>