<?php if( get_row_layout() == 'three_column_image_and_downloads' ) {  
  $title = get_sub_field('title');

  if( have_rows('documents') ){ ?>
  <div class="three_column_image_and_downloads repeatable">
    <div class="wrapper">
      <?php if($title){ ?>
        <h2 data-aos="fade-down"><?php echo $title; ?></h2>
      <?php } ?>
      <div class="flexwrap">
        <?php while( have_rows('documents') ){ the_row();
          $document_title = get_sub_field('document_title');
          $image = get_sub_field('image');
          $button = get_sub_field('button');
          
          if ( $title || $button ) { ?>
            <div class="flexcol textcol" data-aos="fade-right">
              <div class="inside">
                <?php if ( $image ) { ?>
                  <figure data-aos="fade-left">
                    <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>" />
                </figure>
                <?php } ?>
                <?php if ($title) { ?>
                  <h3 class="s-title"><?php echo $title ?></h3>
                <?php } ?>
                <?php 
                  $button_text = (isset($button['title']) && $button['title']) ? $button['title'] : 'View';
                  $button_link = (isset($button['url']) && $button['url']) ? $button['url'] : '';
                  $button_target = (isset($button['target']) && $button['target']) ? $button['target'] : '_self';

                  if($button_text && $button_link) {
                ?>
                  <div class="button-link">
                    <a href="<?php echo $button_link; ?>" target="_blank"><?php echo $button_text; ?></a>
                  </div>
                <?php } ?>
              </div>
            </div>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
  </div>
<?php    
    }
  }
?>
