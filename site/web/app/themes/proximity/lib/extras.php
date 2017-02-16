<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Headcer Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Footer',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-settings',
	));
	
}

namespace PDL;

function social() {
	
	if( have_rows('social_accounts', 'option') ):
		echo '<ul class="social hidden-sm-down">';		
		while ( have_rows('social_accounts', 'option') ) : the_row(); ?>
			<li>
				<a href="<?php the_sub_field('account_url'); ?>" target="_blank" rel="nofollow">
					<i class="fa fa-<?php the_sub_field('provider'); ?>" aria-hidden="true"></i>
				</a>
			</li>
		<?php endwhile;
		echo '</ul>';
	else :
	
		// no rows found
	
	endif;
	
}

// Content Builder ACF
function content_acf() { 

	// check if the flexible content field has rows of data
	if( have_rows('content_builder') ):
	
		// loop through the rows of data
		while ( have_rows('content_builder') ) : the_row();
		
			if( get_row_layout() == 'form' ) {
				get_template_part('templates/acf/form');	
			}

			if( get_row_layout() == 'our_clients' ) {
				get_template_part('templates/acf/our-clients');	
			}

			if( get_row_layout() == 'content_block' ) {
				get_template_part('templates/acf/content-block');	
			}
									
		endwhile;
	
	else :
	
		// no layouts found
	
endif;

}


function homeBanner() { ?>

<div id="hero" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
		<?php
		$i = 0;
		$i1 = 1;
		if( have_rows('slides') ):
		
	    while ( have_rows('slides') ) : the_row(); ?>
				<?php
					$active = '';
					if( $i == 0 ) {
						$active = 'active';
					}
				?>
		    <li data-target="#hero" data-slide-to="<?php echo $i; ?>" class="<?php echo $active; ?>">
		    	<h4><span>0<?php echo $i1; ?></span> | <?php the_sub_field('slide_title'); ?></h4>
		    </li>
	
	    <?php $i++; $i1++; endwhile; 
		
		else :
		
		  // no rows found
		
		endif;
		
		?>

  </ol>
  <div class="carousel-inner" role="listbox">
		<?php
		$slides = 0;
		if( have_rows('slides') ):
		
	    while ( have_rows('slides') ) : the_row(); ?>
				<?php
					$active = '';
					if( $slides == 0 ) {
						$active = 'active';
					}
				?>
		    <div class="carousel-item <?php echo $active; ?>">
			    <div class="carousel-background" style="background-image: url(<?php the_sub_field('slide_image'); ?>);"></div>
			    <div id="<?php the_sub_field('slide_title'); ?>" class="carousel-caption d-none d-md-block">
				  	<h2><img class="icon" src="<?php the_sub_field('slide_icon'); ?>"/> <?php the_sub_field('slide_title'); ?></h2> 
				  	<p><?php the_sub_field('slide_description'); ?></p>
				  	<a href="<?php the_sub_field('slide_button_url'); ?>" class="btn btn-primary">
					  	<?php the_sub_field('slide_button_text'); ?>
				  	</a>
			    </div>
		      
		    </div>
	
	    <?php $slides++; endwhile; 
		
		else :
		
		  // no rows found
		
		endif;
		
		?>

  </div>
</div>
	
	
<?php }