<?php if( get_row_layout() == 'two_column_icons_and_gallery' ) { 
  $title = get_sub_field('title');
  $content_repeater = get_sub_field('content');
  $gallery_position = get_sub_field('gallery_position');
  $gallery = get_sub_field('gallery');
  $column_class = ( $content_repeater && $gallery ) ? 'half':'full';
  if($gallery_position) {
    $column_class .= ' gallery-'.$gallery_position;
  }
  if( $title || $content_repeater || $gallery ) { ?>
  <div class="two_column_icons_and_gallery repeatable">
    <?php if ($title) { ?>
      <div class="wrapper titlediv">
        <h2 class="s-title"><?php echo $title ?></h2>
      </div>
    <?php } ?>
    <div class="flexwrap <?php echo $column_class ?>">
      <?php if ($content_repeater) { ?>
        <div class="textcol" data-aos="fade-right">
          <div class="inside">
          <?php foreach ($content_repeater as $c) { 
            $c_icon = $c['icon'];
            $c_title = $c['title'];
            $c_text = $c['text'];
            if($c_title || $c_text) { ?>
            <div class="icon-text">
              <?php if ($c_icon) { ?>
               <div class="c-icon">
                 <img src="<?php echo $c_icon['url'] ?>" alt="">
               </div> 
              <?php } ?>
              <?php if ($c_title) { ?>
               <h3 class="c-title"><?php echo $c_title ?></h3>
              <?php } ?>
              <?php if ($c_text) { ?>
               <div class="c-text"><?php echo anti_email_spam($c_text) ?></div>
              <?php } ?>
            </div>
            <?php } ?>
          <?php } ?>
          </div>
        </div>
      <?php } ?>

      <?php if ($gallery) { $count = count($gallery); ?>
      <div class="imagecol" data-aos="fade-left">
        <div class="gallery-column galler-count-<?php echo $count ?>">
        <?php foreach ($gallery as $g) { ?>
          <figure>
            <img src="<?php echo $g['url'] ?>" alt="<?php echo $g['title'] ?>" class="gallery"> 
          </figure>
        <?php } ?>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
  <?php } ?>
<?php } ?>