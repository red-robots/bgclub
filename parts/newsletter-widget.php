<?php
$newsletter_image = get_field('newsletter_featured_image','option');
$newsletter_title1 = get_field('newsletter_title1','option');
$newsletter_title2 = get_field('newsletter_title2','option');
$newsletter_text = get_field('newsletter_text','option');
$newsletter_html = get_field('newsletter_html','option');
if($newsletter_image || $newsletter_html || $newsletter_text ) { ?>
<section class="newsletter-footer-widget watch-section">
  <div class="flexwrap">
    <?php if ($newsletter_image) { ?>
    <figure class="imageCol" data-aos="fade-right" data-aos-easing="linear" data-aos-duration="800" data-aos-delay="300" data-aos-offset="100">
      <img src="<?php echo $newsletter_image['url'] ?>" alt="<?php echo $newsletter_image['title'] ?>">
    </figure>  
    <?php } ?>

    <?php if ($newsletter_html || $newsletter_text) { ?>
    <div class="textCol" data-aos="fade-left" data-aos-easing="ease-in-back" data-aos-duration="800" data-aos-delay="300" data-aos-offset="100">
      <div class="inner">
        <?php if ($newsletter_title1) { ?>
         <div class="small-title"><?php echo $newsletter_title1 ?></div> 
        <?php } ?>
        <?php if ($newsletter_title2) { ?>
         <h2 class="big-title"><?php echo $newsletter_title2 ?></h2> 
        <?php } ?>
        <?php if ($newsletter_text) { ?>
         <div class="signup-intro"><?php echo $newsletter_text ?></div> 
        <?php } ?>
        <?php if ($newsletter_html) { ?>
         <div class="signup-form-html"><?php echo $newsletter_html ?></div> 
        <?php } ?>
      </div>
    </div>  
    <?php } ?>
  </div>
</section>
<?php } ?>