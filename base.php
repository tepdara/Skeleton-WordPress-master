<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>
  <?php
    do_action('get_header');
    // Use Bootstrap's navbar if enabled in config.php
    if (current_theme_supports('bootstrap-top-navbar')) {
      get_template_part('templates/header-top-navbar');
    } else {
      get_template_part('templates/header');
    }
  ?>
  <?php if ( !is_front_page() && !is_home() && !is_single() ) : ?>
	
		<?php get_template_part('templates/page', 'header'); ?>
	
  <?php endif; ?>
  <div class="wrap container" role="document">
    <div class="content row">
      <main class="main <?php echo skeleton_main_class(); ?>" role="main">
        <?php include skeleton_template_path(); ?>
      </main>
      <?php if (skeleton_display_sidebar()) : ?>
        <aside class="sidebar <?php echo skeleton_sidebar_class(); ?>" role="complementary">
          <?php include skeleton_sidebar_path(); ?>
        </aside>
      <?php endif; ?>
    </div>
  </div>
  <?php get_template_part('templates/footer'); ?>
</body>
</html>
