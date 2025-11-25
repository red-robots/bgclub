<?php if( get_row_layout() == 'fullwidth_content' ) {  
  $content = get_sub_field('textcontent');
  $embed_script = get_sub_field('embed_script');
  $has__embed__script = ($embed_script) ? true : false;
  $bgcolor = (get_sub_field('bgcolor')) ? get_sub_field('bgcolor') : '#F8AE00';
  $textcolor = (get_sub_field('textcolor')) ? get_sub_field('textcolor') : '#FFFFFF';
  if($content || $embed_script) { ?>
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
    <div class="inner-wrapper" data-aos="fade-up">
    <?php if ($content) { ?>
      <div class="wrapper">
        <div class="textwrap"><?php echo anti_email_spam($content) ?></div>
      </div>
    <?php } ?>
    <?php if ($embed_script) { ?>
      <div class="wrapper">
        <div class="textwrap embed">
          <?php echo anti_email_spam($embed_script) ?>
        </div>
      </div>
    <?php } ?>
    </div>
  </div>
  <?php } ?>
<?php } ?>