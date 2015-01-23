<time class="published" datetime="<?php echo get_the_time('c'); ?>"><?php echo get_the_date(); ?></time>
<!--<p class="byline author vcard"><?php echo __('By', 'skeleton'); ?> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?php echo get_the_author(); ?></a></p>-->
<span class="cate"> <?php the_category(' , ') ?> </span>
<span class="comment-count"> <?php comments_number(); ?> </span>
<span class="post-counter"> <?php echo getPostViews(get_the_ID()); ?> </span>