<?php if( get_row_layout() == 'fullwidth_content_bgimage' ) {
  $title = get_sub_field('title');
  $content = get_sub_field('textcontent');
  $bgimage = get_sub_field('bgimage');
  $button = get_sub_field('button');
  $overlaycolor = (get_sub_field('overlay_color')) ? get_sub_field('overlay_color') : '#006FBA';
  $textcolor = (get_sub_field('textcolor')) ? get_sub_field('textcolor') : '#FFFFFF';
  $button_color = (get_sub_field('button_color')) ? get_sub_field('button_color') : '#7FB02C';
  $button_text_color = (get_sub_field('button_text_color')) ? get_sub_field('button_text_color') : '#FFFFFF';
  $has_class = ($bgimage) ? 'has-overlay' : '';
  if($title || $content) { ?>
  <?php if($overlaycolor || $textcolor || $bgimage){ ?>
    <style>
      <?php if($bgimage) { ?>
        #fullwidth_content_repeatable--<?php echo $i ?>{
          background-image: url('<?php echo $bgimage['url']; ?>');
        }
        #fullwidth_content_repeatable--<?php echo $i ?>.has-overlay:after{
          background-color: <?php echo $overlaycolor; ?>
        }
      <?php } ?>
        #fullwidth_content_repeatable--<?php echo $i ?> h1,
        #fullwidth_content_repeatable--<?php echo $i ?> h2,
        #fullwidth_content_repeatable--<?php echo $i ?> h3,
        #fullwidth_content_repeatable--<?php echo $i ?> h4,
        #fullwidth_content_repeatable--<?php echo $i ?> h5,
        #fullwidth_content_repeatable--<?php echo $i ?> h6,
        #fullwidth_content_repeatable--<?php echo $i ?> p,
        #fullwidth_content_repeatable--<?php echo $i ?> * {
          color: <?php echo $textcolor ?>;
        }
        #fullwidth_content_repeatable--<?php echo $i ?> .button-link a {
          background-color: <?php echo $button_color; ?>;
          color: <?php echo $button_text_color ?>;
        }
        #fullwidth_content_repeatable--<?php echo $i ?> .button-link a:hover {
          background-color: <?php echo $button_text_color; ?>;
          color: <?php echo $button_color ?>;
        }
    </style>
    <?php } ?>

    <div id="fullwidth_content_repeatable--<?php echo $i ?>" class="fullwidth_content_repeatable fullwidth_content_repeatable_bgimage repeatable <?php echo $has_class; ?>">
      <div class="wrapper">
        <div class="flexwrap">
          <h2><?php echo $title; ?></h2>
          <div class="textwrap"><?php echo $content; ?></div>
          <?php 
            $button_text = (isset($button['title']) && $button['title']) ? $button['title'] : '';
            $button_link = (isset($button['url']) && $button['url']) ? $button['url'] : '';
            $button_target = (isset($button['target']) && $button['target']) ? $button['target'] : '_self';

            if($button_text && $button_link) {
          ?>
            <div class="button-link">
              <a href="<?php echo $button_link; ?>" target="<?php echo $button_target; ?>"><?php echo $button_text; ?></a>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  <?php } ?>
<?php } ?>