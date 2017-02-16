<div class="row our-clients heading-row">
	<div class="col-sm-12">
		<h2>
			<?php 
				$heading = get_sub_field('clients_heading');
				if($heading) {
					echo $heading;
				} else {
					echo 'Our Clients';
				}
			?>
		</h2>
	</div>
</div>
<div class="row content-row no-gutters">
	<?php
	$i = 0; 
	$active = '';
	$args = array(
		'post_type' => 'clients',
		'posts_per_page' => 6
	);
	
	// the query
	$the_query = new WP_Query( $args ); ?>
	
	<?php if ( $the_query->have_posts() ) : ?>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); $i++; ?>
				<div class="col-sm-2">
					<?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) ); ?>
				</div>
			<?php endwhile; ?>	
		<?php wp_reset_postdata(); ?>
	
	<?php else : ?>
		<p><?php _e( 'Sorry, there are no clients.' ); ?></p>
	<?php endif; ?>
<!--
	<div class="col-sm-12">
		<a href="/clients">- All Clients</a>
	</div>
-->
</div>
