<?php if( get_row_layout() == 'simple_fullwidth_content_normal' ) { 
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
      <div class="wrapper" data-aos="fade-up">
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