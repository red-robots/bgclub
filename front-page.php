<?php get_header(); ?>
<div id="primary">
  <main class="main-content">
  <?php while ( have_posts() ) : the_post(); ?>
    
    <?php if( $clubs = get_field('clubs') ) { ?>
    <section class="join-the-club">
      <div class="flexwap">
        <?php $j=1; foreach ($clubs as $c) { 
          $title = $c['title'];
          $btn = $c['button'];
          $image = $c['image'];
          $bgcolor = ($c['bgcolor']) ? $c['bgcolor'] : 'transparent';
          $btnTitle = (isset($btn['title']) && $btn['title']) ? $btn['title'] : '';
          $btnUrl = (isset($btn['url']) && $btn['url']) ? $btn['url'] : '';
          $btnTarget = (isset($btn['target']) && $btn['target']) ? $btn['target'] : '_self';
          $animate = ($j==2) ? 'fade-left':'fade-right';
          if($title) { ?>
          <div class="flexcol" data-aos="<?php echo $animate ?>">
            <div class="inner" style="background-color:<?php echo $bgcolor ?>">
              <div class="caption">
                <div class="title"><?php echo $title ?></div>
                <?php if ($btnTitle && $btnUrl) { ?>
                <a href="<?php echo $btnUrl ?>" target="<?php echo $btnTarget ?>" class="btn" style="background-color:<?php echo $bgcolor ?>"><?php echo $btnTitle ?></a>
                <?php } ?>
              </div>
              <figure>
                <?php if ($image) { ?>
                  <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>">
                <?php } ?>
              </figure>
            </div>
          </div>
          <?php $j++; } ?>
        <?php } ?>
      </div>
    </section>
    <?php } ?>

    <?php if( $intro_content = get_field('intro_content') ) { ?>
    <section class="intro-content-block">
      <div class="bg" data-aos="fade-up-left"></div>
      <div class="wrapper">
        <div data-aos="zoom-in-up"><?php echo $intro_content ?></div>
      </div>
    </section>
    <?php } ?>

    <?php 
    $number_title = get_field('number_title');
    $numbers = get_field('numbers');
    if( $number_title || $numbers ) { ?>
    <section class="numbers-content">
      <div class="flexwap">
        <?php if ($number_title ) { ?>
        <div class="flexcol titleCol" data-aos="fade-right" data-aos-duration="1500">
          <h2><?php echo $number_title ?></h2>
        </div>
        <?php } ?>
        <?php if ($numbers ) { ?>
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
        <?php } ?>
      </div>
    </section>
    <?php } ?>


    <?php if( $event_title = get_field('event_title') ) { 
      $shortcode_left = get_field('shortcode_left');
      $shortcode_right = get_field('shortcode_right');
    ?>
    <section class="events-content-block">
      <div class="wrapper">
        <h2 class="section-title" data-aos="fade-down" data-aos-duration="1500"><?php echo $event_title ?></h2>
        <?php if ($shortcode_left || $shortcode_right) { ?>
        <div class="flexwrap">
          <?php if ($shortcode_left && do_shortcode($shortcode_left) ) { ?>
          <div class="flexcol left" data-aos="zoom-in" data-aos-easing="linear" data-aos-duration="800">
            <?php echo do_shortcode($shortcode_left); ?>
          </div>
          <?php } ?>

          <?php if ($shortcode_right && do_shortcode($shortcode_right) ) { ?>
          <div class="flexcol right" data-aos="fade-left" data-aos-duration="1500" data-aos-delay="500">
            <div id="eventCalendarList"></div>
            <?php 
              if(strpos($shortcode_right, 'show=') !== false) {
                $shortcodeStr = explode('show=', $shortcode_right);
                $displayNum = end($shortcodeStr);
                $displayNum = preg_replace('/[^0-9]/', '', $displayNum);   
              }  
              $cal = get_field('calendar_link');
              $cLink = ( isset($cal['url']) && $cal['url'] ) ? $cal['url'] : '';
              $cTitle = ( isset($cal['title']) && $cal['title'] ) ? $cal['title'] : '';
              $cTarget = ( isset($cal['target']) && $cal['target'] ) ? $cal['target'] : '_self';
            ?>
            <div id="gcalendarData"><?php echo do_shortcode($shortcode_right) ?></div>
            <div id="gCalendarList" data-show="<?php echo $displayNum ?>"></div>
            <?php if ($cLink && $cTitle) { ?>
            <div class="buttondiv">
              <a href="<?php echo $cLink ?>" target="<?php echo $cTarget ?>" class="button-green"><?php echo $cTitle ?></a>
            </div> 
            <?php } ?>
          </div>
          <?php } ?>

        </div>
        <?php } ?>
      </div>
    </section>
    <?php
      }

      get_template_part( 'parts/top', 'supporters' );

      get_template_part( 'parts/social', 'news' );  
    ?>

  <?php endwhile; ?>
  </main>
</div>
<?php
get_footer();