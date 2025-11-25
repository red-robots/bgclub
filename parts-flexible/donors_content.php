<?php if( get_row_layout() == 'donors_content' ) {  
  $title = get_sub_field('title');
  $content = get_sub_field('details');
  $gallery = get_sub_field('images');
  $hide_indicators = get_sub_field('hide_carousel_indicators');
  $has_indicators = ($hide_indicators) ? '' : 'true';
  if($title || $content || $gallery) { ?>
  <div class="repeatable-content repeatable--<?php echo get_row_layout() ?> repeatable--<?php echo get_row_layout() ?>-<?php echo $i ?>">
    <div class="repeatable-inner" data-aos="fade-up">
      
      <?php if ($title || $content) { ?>
      <div class="wrapper">
        <?php if ($title) { ?>
        <h2 class="s-title fullwidth"><?php echo $title ?></h2>
        <?php } ?>
        <?php if ($content) { ?>
        <div class="textwrap"><?php echo anti_email_spam($content) ?></div>
        <?php } ?>
      </div>
      <?php } ?>

      <?php if ($gallery) { $count = count($gallery); ?>
      <div class="wrapper">
        <div class="gallery-column galler-count-<?php echo $count ?>">
          <div class="gallery-slider" data-has-indicators="<?php echo $has_indicators ?>">
            <?php foreach ($gallery as $g) { 
              $websiteUrl = get_field('attachment_website', $g['ID']);
            ?>
              <figure>
                <?php if ($websiteUrl) { ?>
                  <a href="<?php echo $websiteUrl ?>" class="image-anchor-link" target="_blank">
                    <img src="<?php echo $g['url'] ?>" alt="<?php echo $g['title'] ?>" class="gallery">
                  </a>
                <?php } else { ?>
                  <img src="<?php echo $g['url'] ?>" alt="<?php echo $g['title'] ?>" class="gallery">
                <?php } ?>
              </figure>
            <?php } ?>
          </div>
        </div>
      </div>  
      <?php } ?>

    </div>
  </div>
  <?php } ?>
<?php } ?>