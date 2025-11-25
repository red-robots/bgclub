<?php if( get_row_layout() == 'two_column_text_number_blocks' ) { 
  $section_intro = get_sub_field('section_intro');
  $title = get_sub_field('title');
  $content = get_sub_field('textcontent');
  $text_alignment = get_sub_field('text_alignment');
  $text_alignment = ($text_alignment) ? $text_alignment : 'left';
  
  $buttons = get_sub_field('buttons');
  $bgcolor = (get_sub_field('bgcolor')) ? get_sub_field('bgcolor') : '#FFF';
  $textcolor = (get_sub_field('textcolor')) ? get_sub_field('textcolor') : '#6F6F6F';
  $link_color = (get_sub_field('link_color')) ? get_sub_field('link_color') : '#6F6F6F';

  $numbers = get_sub_field('numbers');
  $numbers_position = get_sub_field('numbers_block_position');
  $column_class = ( ($title || $content) && $numbers ) ? 'half':'full';
  if($numbers_position) {
    $column_class .=' numbers-block-' . $numbers_position;
  }
  if($title || $content || $section_intro || $numbers) { ?>
  <div class="<?php echo get_row_layout() ?> <?php echo get_row_layout() ?>--<?php echo $i ?> repeatable">
    <style>
      .<?php echo get_row_layout() ?>--<?php echo $i ?> h2,
      .<?php echo get_row_layout() ?>--<?php echo $i ?> p {color:<?php echo $textcolor ?>;}
      <?php if ($bgcolor) { ?>
      .<?php echo get_row_layout() ?>--<?php echo $i ?> .textBlock {background-color:<?php echo $bgcolor ?>;}
      <?php } ?>
      <?php if ($link_color) { ?>
      .<?php echo get_row_layout() ?>--<?php echo $i ?> .text a:not(.repeatable-btn){color:<?php echo $link_color ?>;}
      <?php } ?>
    </style>

    <?php if ($title || $section_intro) { ?>
    <div class="section_intro">
      <div class="wrapper">
        <?php if ($title) { ?>
        <h2 class="s-title fullwidth"><?php echo $title ?></h2>
        <?php } ?>
        <?php if ($section_intro) { ?>
        <div class="intro">
          <?php echo anti_email_spam($section_intro) ?>
        </div>
        <?php } ?> 
      </div>
    </div>
    <?php } ?> 

    <?php if ($content || $numbers) { 
      $is_in_view = (isset($has__embed__script) && $has__embed__script) ? ' watch-section':'';
    ?>
    <div class="section-columns<?php echo $is_in_view ?>">
      <div class="flexwrap <?php echo $column_class ?>">

        <?php if ($title || $content) { ?>
        <div class="textBlock text-align-<?php echo $text_alignment ?>">
          <div class="wrap">
            <?php if ($content || $buttons) { ?>
            <div class="text">
              <div class="description"><?php echo anti_email_spam($content) ?></div>
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
            <?php } ?>  
          </div>
        </div>
        <?php } ?>

        <?php if ($numbers) { ?>
        <div class="numbersBlock numbers-content">
          <div class="flexcol numCol">
            <?php foreach ($numbers as $n) { 
              $number = $n['number'];
              $description = $n['description'];
              $bgcolor = ($n['bgcolor']) ? $n['bgcolor'] : 'transparent';
              if ($number || $description) { ?>
              <div class="block" data-aos="flip-up" style="background-color:<?php echo $bgcolor ?>">
                <?php if ($number) { 
                  $number = trim($number);
                  $dataNum = str_replace('%','',$number);
                  $dataNumExtra = (strpos($number, '%') !== false) ? '%' : '';
                  ?>
                  <div class="number">
                    <span class="count" data-number="<?php echo $dataNum ?>"><?php echo $dataNum ?></span><?php echo $dataNumExtra ?>
                  </div>
                <?php } ?>
                <?php if ($description) { ?>
                  <div class="description"><?php echo $description ?></div>
                <?php } ?>
              </div>
              <?php } ?>
            <?php } ?>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
    <?php } ?>
    
  </div>
  <?php } ?>
<?php } ?>
