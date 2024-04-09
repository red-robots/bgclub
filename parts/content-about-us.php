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