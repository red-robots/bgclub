<?php
  $title = get_field('support_title');
  $content = get_field('support_content');
  $content = apply_filters('the_content',$content);
  $title = get_field('support_title');

  if($title):
?>
<section class="support-container">
  <div class="wrapper">
    <h2><?php echo $title; ?></h2>
    <?php if($content): ?>
      <div class="content">
        <?php echo $content; ?>
      </div>
    <?php
      endif;
    
      if( have_rows('companies') ): ?>
        <div class="support-slider">
          <?php while( have_rows('companies') ): the_row(); 
              $image = get_sub_field('company_image');
              //$name = get_sub_field('company_name');
              $link = get_sub_field('company_url');

              if($image):
          ?>
              <div class="slider-info">
                <?php if($link){ echo '<a href="'. $link .'" target="_blank">'; } ?>
                  <figure>
                    <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>">
                  </figure>
                <?php if( $link ){ echo '</a>'; } ?>
                <!-- <p><?php echo $name; ?></p> -->
              </div>
          <?php
              endif;
            endwhile;
          ?>
        </div>
    <?php endif; ?>

  </div>
</section>

<?php endif; ?>