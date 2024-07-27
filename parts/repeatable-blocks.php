<?php 
$post_id = get_the_ID();
if( have_rows('flexible_content', $post_id) ) { ?>
  <?php $i=1; while( have_rows('flexible_content',$post_id) ): the_row(); ?>

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
              <div class="textcol">
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
              <div class="imagecol">
                <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>" />
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <?php } ?>
    <?php } 


    else if( get_row_layout() == 'fullwidth_content' ) {  
      $content = get_sub_field('textcontent');
      $bgcolor = (get_sub_field('bgcolor')) ? get_sub_field('bgcolor') : '#F8AE00';
      $textcolor = (get_sub_field('textcolor')) ? get_sub_field('textcolor') : '#FFFFFF';
      if($content) { ?>
      <style>
        #fullwidth_content_repeatable--<?php echo $i ?> h1,
        #fullwidth_content_repeatable--<?php echo $i ?> h2,
        #fullwidth_content_repeatable--<?php echo $i ?> h3,
        #fullwidth_content_repeatable--<?php echo $i ?> h4,
        #fullwidth_content_repeatable--<?php echo $i ?> h5,
        #fullwidth_content_repeatable--<?php echo $i ?> h6,
        #fullwidth_content_repeatable--<?php echo $i ?> p {
          color: #FFF;
        }
      </style>
      <div id="fullwidth_content_repeatable--<?php echo $i ?>" class="fullwidth_content_repeatable repeatable" style="background-color:<?php echo $bgcolor ?>;color:<?php echo $textcolor ?>">
        <div class="wrapper">
          <div class="textwrap"><?php echo anti_email_spam($content) ?></div>
        </div>
      </div>
      <?php } ?>
    <?php } 


    else if( get_row_layout() == 'two_column_image_and_downloads' ) {  
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
            <div class="textcol">
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
            <div class="imagecol">
              <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>" />
            </div>
          <?php } ?>
        </div>
      </div>
      <?php } ?>
    <?php } 

    else if( get_row_layout() == 'two_column_icons_and_gallery' ) { 
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
            <div class="textcol">
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
          <div class="imagecol">
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
    <?php } 

    else if( get_row_layout() == 'simple_fullwidth_content_normal' ) { 
      $title = get_sub_field('title');
      $content = get_sub_field('content');
      $bgcolor = get_sub_field('bgcolor');
      $textcolor = get_sub_field('textcolor'); ?>

      <?php if($title || $content) { ?>
        <?php if($bgcolor || $textcolor) { ?>
        <style>
          <?php if($bgcolor) { ?>
            #simple_fullwidth_content_normal--<?php echo $i ?>{
              background-color: <?php echo $bgcolor ?>;
            }
          <?php } ?>

          <?php if($textcolor) { ?>
          #simple_fullwidth_content_normal--<?php echo $i ?> * {
            color: <?php echo $textcolor ?>;
          }
          <?php } ?>
        </style>
        <?php } ?>
        <div id="simple_fullwidth_content_normal--<?php echo $i ?>" class="simple_fullwidth_content_normal repeatable">
          <div class="wrapper">
            <?php if ($title) { ?>
              <div class="wrapper titlediv">
                <h2 class="s-title"><?php echo $title ?></h2>
              </div>
            <?php } ?>
            <?php if ($content) { ?>
              <div class="wrapper textcontent">
                <?php echo anti_email_spam($content); ?>
              </div>
            <?php } ?>
          </div>
        </div>
      <?php } ?>

    <?php } ?>

  <?php $i++; endwhile; ?>
<?php } ?>