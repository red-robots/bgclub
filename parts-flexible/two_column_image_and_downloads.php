<?php if( get_row_layout() == 'two_column_image_and_downloads' ) {  
  $title = get_sub_field('title');
  $buttons = get_sub_field('buttons');
  $image = get_sub_field('image');
  $image_position = get_sub_field('image_position');
  $column_class = ( ($title || $buttons) && $image ) ? 'half':'full';
  if($image_position) {
    $column_class .= ' image-' . $image_position;
  }
  if($title || $buttons || $image) { ?>
  <div class="two_column_image_and_downloads repeatable">
    <div class="flexwrap <?php echo $column_class ?>">
      <?php if ( $title || $buttons ) { ?>
        <div class="textcol" data-aos="fade-right">
          <div class="inside">
            <?php if ($title) { ?>
              <h2 class="s-title"><?php echo $title ?></h2>
            <?php } ?>
            <?php if ($buttons) { ?>
            <div class="buttons">
              <?php foreach ($buttons as $bt) { 
                if( $b = $bt['button'] ) {
                  $btnUrl = $b['url'];
                  $btnTitle = $b['title'];
                  $btnTarget = ( isset($b['target']) && $b['target'] ) ? $b['target'] : '_self';
                  ?>
                  <a href="<?php echo $btnUrl ?>" target="<?php echo $btnTarget ?>" class="repeatable-btn btn-round"><?php echo $btnTitle ?></a>
                <?php } ?>
              <?php } ?>
            </div>
            <?php } ?>
          </div>
        </div>
      <?php } ?>
      <?php if ( $image ) { ?>
        <div class="imagecol" data-aos="fade-left">
          <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>" />
        </div>
      <?php } ?>
    </div>
  </div>
  <?php } ?>
<?php } ?>
