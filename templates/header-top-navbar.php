<header class="navbar navbar-default navbar-static-top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
    </div>
    <nav class="collapse navbar-collapse" role="navigation">
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
        endif;
        if (has_nav_menu('secondary_navigation')) :
          wp_nav_menu(array('theme_location' => 'secondary_navigation', 'menu_class' => 'nav navbar-nav navbar-right'));
        endif;
      ?>
    </nav>
  </div>
</header>

<?php if (is_category() || is_single()): ?>
<div class="sub-menu navbar">
	<div class="container">
	<?php
    $category = get_category( get_query_var( 'cat' ) );
	if ($category->category_parent > 0){
		wp_list_categories( array('child_of' => $category->category_parent, 'hide_empty' => 0 ,'depth' => 1,'title_li' => '', 'show_option_none' => '')); 
	}
	elseif (is_single()){
		$categories = get_the_category( $post->ID );
		$category = get_category($categories[0]-> term_id)->parent;
		if ($category > 0){
			wp_list_categories( array('child_of' => $category, 'hide_empty' => 0 ,'depth' => 1,'title_li' => '', 'show_option_none' => '')); 
		}
		else{
			echo '</div> </div>';
			return;
		}
	}
	else{	
	wp_list_categories( array('child_of' => $category->cat_ID, 'hide_empty' => 0 ,'depth' => 1,'title_li' => '', 'show_option_none' => '')); 
	}
	?>
</div>
</div>
<?php endif; ?>


