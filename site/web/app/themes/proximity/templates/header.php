<header class="banner">
  <div class="container-fluid">
    <a class="brand" href="<?= esc_url(home_url('/')); ?>">
	    <?php //bloginfo('name'); ?>
			<img class="img-fluid" src="<?php the_field('logo_image', 'option') ?>"/>
	  </a>
    <nav class="nav-primary hidden-sm-down">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
      endif;
      ?>
    </nav>
    <?= PDL\social(); ?>
  </div>
</header>
