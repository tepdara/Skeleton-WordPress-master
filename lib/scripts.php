<?php
/**
 * Enqueue scripts and stylesheets
 *
 * Enqueue stylesheets in the following order:
 * 1. /theme/assets/css/bootstrap.min.css
 * 2. /theme/assets/css/reset.css
 * 3. /theme/assets/css/font-awesome.min.css
 *
 * Enqueue scripts in the following order:
 * 1. jquery-1.10.2.min.js via Google CDN
 * 2. /theme/assets/js/vendor/modernizr-2.7.0.min.js
 * 3. /theme/assets/js/bootstrap.min.js (in footer)
 */
function skeleton_scripts() {
  wp_enqueue_style('skeleton_main', get_template_directory_uri() . '/assets/css/bootstrap.min.css', false, null);
  wp_enqueue_style('skeleton_reset', get_template_directory_uri() . '/assets/css/reset.css', false, null);
  wp_enqueue_style('skeleton_font_awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', false, null);
  
  // jQuery is loaded using the same method from HTML5 Boilerplate:
  // Grab Google CDN's latest jQuery with a protocol relative URL; fallback to local if offline
  // It's kept in the header instead of footer to avoid conflicts with plugins.
  if (!is_admin() && current_theme_supports('jquery-cdn')) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', false, null, false);
    add_filter('script_loader_src', 'skeleton_jquery_local_fallback', 10, 2);
  }

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_register_script('modernizr', get_template_directory_uri() . '/assets/js/modernizr-2.7.0.min.js', false, null, true);
  wp_register_script('skeleton_scripts', get_template_directory_uri() . '/assets/js/bootstrap.min.js', false, null, true);
  wp_enqueue_script('modernizr');
  wp_enqueue_script('jquery');
  wp_enqueue_script('skeleton_scripts');
}
add_action('wp_enqueue_scripts', 'skeleton_scripts', 100);

// Add Custom WordPress Login Page CSS
function custom_login_page_css() {
  echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/assets/css/wplogin.css" />';
}
add_action('login_head', 'custom_login_page_css');

// http://wordpress.stackexchange.com/a/12450
function skeleton_jquery_local_fallback($src, $handle = null) {
  static $add_jquery_fallback = false;

  if ($add_jquery_fallback) {
    echo '<script>window.jQuery || document.write(\'<script src="' . get_template_directory_uri() . '/assets/js/jquery-1.10.2.min.js"><\/script>\')</script>' . "\n";
    $add_jquery_fallback = false;
  }

  if ($handle === 'jquery') {
    $add_jquery_fallback = true;
  }

  return $src;
}
add_action('wp_head', 'skeleton_jquery_local_fallback');

function insert_copyright_notice() {
	$theme = wp_get_theme( '' );
	echo '<style>.copyright .col-lg-12 { margin-top: 0px; }</style>';
	echo '<div class="copyright container" role="copyright"><div class="row"><div class="col-lg-12">';
	echo '<p>' . $theme . ' WordPress Theme by <a href="http://himpfen.com/" title="Brandon Himpfen">Brandon Himpfen</a>.</p>';
	echo '</div></div></div>';
}
add_action('wp_footer', 'insert_copyright_notice');

function skeleton_google_analytics() { ?>
<script>
  (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
  function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
  e=o.createElement(i);r=o.getElementsByTagName(i)[0];
  e.src='//www.google-analytics.com/analytics.js';
  r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
  ga('create','<?php echo GOOGLE_ANALYTICS_ID; ?>');ga('send','pageview');
</script>

<?php }
if (GOOGLE_ANALYTICS_ID && !current_user_can('manage_options')) {
  add_action('wp_footer', 'skeleton_google_analytics', 20);
}
