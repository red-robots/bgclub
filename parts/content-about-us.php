<?php
$intro_image = get_field('intro_image');
$intro_text = get_field('intro_text');
$intro_class = ($intro_image && $intro_text) ? 'half':'full';
if($intro_image || $intro_text) { ?>
<section class="about-intro section-wide">
  <div class="flexwrap <?php echo $intro_class ?>">
    <?php if ($intro_image) { ?>
     <figure class="flexcol imageCol">
       <img src="<?php echo $intro_image['url'] ?>" alt="<?php echo $intro_image['title'] ?>">
     </figure> 
    <?php } ?>

    <?php if ($intro_text) { ?>
     <div class="flexcol textCol">
      <?php echo $intro_text ?>
     </div> 
    <?php } ?>
  </div>
</section>
<?php } ?>

<?php if( $fullwidth = get_field('fullwidth_content') ) { ?>
<section class="about-fullwidth section-wide">
  <div class="wrapper">
    <div class="textwrap"><?php echo $fullwidth ?></div>
  </div>
</section>
<?php } ?>

<?php 
$core_title = get_field('core_title');
$core_texts = get_field('core_text');
$core_gallery = get_field('core_gallery');
$core_class = ($core_texts && $core_gallery) ? 'half':'full';
if( $core_title || $core_text ) { ?>
<section class="about-core-section section-wide">
  <div class="wrapper">
    <?php if ($core_title) { ?>
     <h2 class="title"><?php echo $core_title ?></h2> 
    <?php } ?>

    <div class="flexwrap <?php echo $core_class ?>">
      <?php if ($core_texts) { ?>
      <div class="textwrap">
        <?php foreach ($core_texts as $c) { 
          $icon = $c['icon'];
          $title = $c['title'];
          $text = $c['text'];
          ?>
          <div class="text-inner">
            <?php if ($icon) { ?>
            <div class="icondiv">
              <img src="<?php echo $icon['url'] ?>" alt="">
            </div> 
            <?php } ?>

            <?php if ($title) { ?>
            <div class="titlediv"><?php echo $title ?></div> 
            <?php } ?>

            <?php if ($text) { ?>
            <div class="textdiv"><?php echo $text ?></div> 
            <?php } ?>
          </div>
        <?php } ?>
      </div>
      <?php } ?>

      <?php if ($core_gallery) { ?>
      <div class="galleries">
        <?php foreach ($core_gallery as $g) { ?>
          <img src="<?php echo $g['url'] ?>" alt="<?php echo $g['title'] ?>">
        <?php } ?>
      </div>
      <?php } ?>
    </div>
  </div>
</section>
<?php } ?>