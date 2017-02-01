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

function homeBanner() {
	if( have_rows('verticals') ):
		echo '<div class="call-to-action row" style="background-image: url('. get_field('hb_background_image') .');">';
			echo '<div class="cta-content">';
				echo '<div class="row vert-wrap">';		
					while ( have_rows('verticals') ) : the_row(); ?>
						<div class="col-sm-4">
							<div class="vert-inner" style="background-image: url(<?php the_sub_field('vert_background_image'); ?>);">
								<h2><?php the_sub_field('vert_heading'); ?></h2>
								<?php the_sub_field('vert_short_description'); ?>
								<a href="<?php the_sub_field('vert_button_url'); ?>" target="_blank" class="btn btn-primary">
									<?php the_sub_field('vert_button_text'); ?>	
								</a>
							</div>
						</div>
					<?php endwhile;
				echo '</div>';
			echo '</div>';
		echo '</div>';
	else :
	
		// no rows found
	
	endif;
	
}