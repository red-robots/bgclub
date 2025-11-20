<?php if( get_row_layout() == 'two_column_text_number_blocks' ) { 
  $section_intro = get_sub_field('section_intro');
  $title = get_sub_field('title');
  $content = get_sub_field('textcontent');
  $numbers = get_sub_field('numbers');
  $numbers_position = get_sub_field('numbers_block_position');
  $column_class = ( ($title || $content) && $numbers ) ? 'half':'full';
  if($numbers_position) {
    $column_class .=' numbers-block-' . $numbers_position;
  }
  if($title || $content || $section_intro || $numbers) { ?>
  <div class="<?php echo get_row_layout() ?> <?php echo get_row_layout() ?>--<?php echo $i ?> repeatable">
    <?php if ($section_intro) { ?>
    <div class="section-intro">
      <div class="wrapper">
        <div class="textcontent"><?php echo anti_email_spam($section_intro) ?></div>
      </div>
    </div>
    <?php } ?>
    <?php if ($title || $content || $numbers) { ?>
    <div class="section-columns">
      <div class="flexwrap <?php echo $column_class ?>">

        <?php if ($title || $content) { ?>
        <div class="textBlock">
          <div class="wrap" data-aos="fade-right">
            <?php if ($title) { ?>
            <h2 class="title"><?php echo $title ?></h2>
            <?php } ?>  
            <?php if ($content) { ?>
            <div class="text"><?php echo anti_email_spam($content) ?></div>
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
