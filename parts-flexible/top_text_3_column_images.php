<?php if( get_row_layout() == 'top_text_3_column_images' ) {  
  $section_title = get_sub_field('section_title');
  $section_text = get_sub_field('section_text');
  $images = get_sub_field('gallery');
  // $bgcolor = (get_sub_field('bgcolor')) ? get_sub_field('bgcolor') : '#F8AE00';
  // $textcolor = (get_sub_field('textcolor')) ? get_sub_field('textcolor') : '#FFFFFF';
  if( ($section_title || $section_text) || $images ) { ?>
  <div id="<?php echo get_row_layout() ?>--<?php echo $i ?>" class="<?php echo get_row_layout() ?> repeatable">
    <div class="inner-wrapper" data-aos="fade-up">
    <?php if ($section_title || $section_text) { ?>
    <div class="section-intro">
      <div class="wrapper">
        <?php if ($section_title) { ?>
        <h2 class="s-title fullwidth"><?php echo $section_title ?></h2>
        <?php } ?>
        <?php if ($section_text) { ?>
        <div class="textwrap"><?php echo anti_email_spam($section_text) ?></div>
        <?php } ?>
      </div>
    </div>  
    <?php } ?>

    <?php if ($images) { $count = count($images); ?>
    <div class="section-gallery">
      <div class="wrapper">
        <div class="gallery-column count-<?php echo $count ?>">
        <?php foreach ($images as $g) { ?>
          <figure>
            <img src="<?php echo $g['url'] ?>" alt="<?php echo $g['title'] ?>" class="gallery"> 
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