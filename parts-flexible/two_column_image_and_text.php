<?php if( get_row_layout() == 'two_column_image_and_text' ) { 
  $title = get_sub_field('title');
  $content = get_sub_field('textcontent');
  $buttons = get_sub_field('buttons');
  $bgcolor = (get_sub_field('bgcolor')) ? get_sub_field('bgcolor') : '#FFF';
  $textcolor = (get_sub_field('textcolor')) ? get_sub_field('textcolor') : '#6F6F6F';
  $link_color = (get_sub_field('link_color')) ? get_sub_field('link_color') : '#6F6F6F';
  $has_paper_edge = get_sub_field('has_paper_edge');
  $image = get_sub_field('image');
  $image_position = get_sub_field('image_position');
  $column_class = ( ($title || $content) && $image ) ? 'half':'full';
  if($image_position) {
    $column_class .=' image-' . $image_position;
  }
  $paper_edge = ($has_paper_edge) ? ' has-paper-edge':'';
  if($title || $content || $image) { ?>
  <div class="two_column_image_and_text two_column_image_and_text--<?php echo $i ?> repeatable<?php echo $paper_edge ?>">
    <style>
      .two_column_image_and_text--<?php echo $i ?> h2,
      .two_column_image_and_text--<?php echo $i ?> p {color:<?php echo $textcolor ?>;}
      <?php if ($link_color) { ?>
        .two_column_image_and_text--<?php echo $i ?> .textcol a:not(.repeatable-btn){color:<?php echo $link_color ?>;}
      <?php } 
        if ($has_paper_edge) { ?>
        .two_column_image_and_text--<?php echo $i ?> .roughEdgePaper{fill:<?php echo $bgcolor ?>!important}
      <?php } ?>
    </style>
    <?php if ($has_paper_edge) { ?>
      <div class="paper-edge"><?php echo get_template_part('parts/paper-edge'); ?></div>
    <?php } ?>
    <div class="repeatable-inner" style="background-color:<?php echo $bgcolor ?>;color:<?php echo $textcolor ?>">
      <?php if ($has_paper_edge) { ?>
        <?php if ($title) { ?>
        <div class="wrapper">
          <h2 class="s-title fullwidth"><?php echo $title ?></h2>
        </div>
        <?php } ?>
      <?php } ?>
      <div class="flexwrap <?php echo $column_class ?>">
        <?php if ( $title || $content ) { ?>
          <div class="textcol" data-aos="fade-right">
            <div class="inside">
              <?php if (!$has_paper_edge) { ?>
                <?php if ($title) { ?>
                <h2 class="s-title"><?php echo $title ?></h2>
                <?php } ?>
              <?php } ?>
              <?php if ($content) { ?>
              <div class="textwrap"><?php echo anti_email_spam($content) ?></div>
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
  </div>
  <?php } ?>
<?php } ?>
