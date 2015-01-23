<?php
/**
 * Shortcodes
 */

// Bloginfo shortcode
function bloginfo_shortcode( $atts ) {
   extract(shortcode_atts(array(
       'value' => '',
   ), $atts));
   return get_bloginfo($value);
}
add_shortcode('bloginfo', 'bloginfo_shortcode');

// Shortcode to include a page in another page
function get_post_page_content( $atts ) {
   extract( shortcode_atts( array(
      'id' => null,
      'title' => false,
   ), $atts ) );
   $the_query = new WP_Query( 'page_id='.$id );
   while ( $the_query->have_posts() ) {
      $the_query->the_post();
         if($title == true){
         echo "<h2>";
         the_title();
         echo "</h2>";
         }
         the_content();
   }
   wp_reset_postdata();
}
add_shortcode( 'get_content', 'get_post_page_content' );