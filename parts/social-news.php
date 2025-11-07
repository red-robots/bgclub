<?php
  $title = get_field('instagram_hashtag_title');
  $shortcode = get_field('instagram_shortcode');

  $posts = array();
  $args = array(
    'posts_per_page'=> 2,
    'post_type'   => 'post',
    'post_status' => 'publish',
    'orderby'       => 'date',       
    'order'         => 'DESC'
  );
  $posts = get_posts($args);

  $colClass = ($shortcode && $post) ? 'col-2' : 'col-1' ;

  if($shortcode):
?>
<section class="social-container">
  <div class="flexwap <?php echo $colClass; ?>">
    
    <?php if($shortcode): ?>
      <div class="flexcol" data-aos="fade-right">
        <div class="inner">
          <h2><?php echo ($title) ? $title : 'Social'; ?></h2>
          <div class="ig-wrapper"><?php echo do_shortcode($shortcode); ?></div>
        </div>
      </div>
    <?php endif; ?>

    <!-- News -->
    <?php if ( $posts ) { ?>
      <div class="flexcol" data-aos="fade-right">
        <div class="inner">
          <div class="news-results">
            <div id="newsContent">
              <div id="newsInner" class="flexwrap">
                <h2>News</h2>
                <?php foreach($posts as $item) {
                  $id = $item->ID;
                  $content = strip_tags( $item->post_content );
                  $content = ($content) ? shortenText($content,100,' ') : '';
                  $thumbID = get_post_thumbnail_id($id);
                  $img = ($thumbID) ? wp_get_attachment_image_src($thumbID,'large') : '';
                  $imgAlt = ($img) ? get_the_title($thumbID) : '';
                  $post_date_text = get_the_date('m/d/Y',$id);
                  ?>
                  <div class="fcol news animated fadeIn">
                    <div class="inside">
                      <?php if ( $img ) { ?>
                      <div class="feat-image">
                        <a href="<?php echo get_permalink($id); ?>"><img src="<?php echo $img[0] ?>" alt="" aria-hidden="true" /></a>
                      </div>  
                      <?php } ?>
                      <div class="textwrap">
                        <div class="postdate">Posted on: <?php echo $post_date_text; ?></div>
                        <h3 class="posttitle"><a href="<?php echo get_permalink($id); ?>"><?php echo get_the_title($id); ?></a></h3>
                        <div class="excerpt"><?php echo $content; ?></div>
                        <div class="button"><a href="<?php echo get_permalink($id); ?>" class="btnlink">Read More</a></div>
                      </div>
                    </div>
                  </div>
                <?php } wp_reset_postdata(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>

  </div>
</section>
<?php endif; ?>