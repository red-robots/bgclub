<?php get_header(); ?>
<div id="primary">
  <main class="main-content">
  <?php while ( have_posts() ) : the_post(); ?>
    
    <?php if( $clubs = get_field('clubs') ) { ?>
    <section class="join-the-club">
      <div class="flexwap">
        <?php foreach ($clubs as $c) { 
          $title = $c['title'];
          $btn = $c['button'];
          $image = $c['image'];
          $bgcolor = ($c['bgcolor']) ? $c['bgcolor'] : 'transparent';
          $btnTitle = (isset($btn['title']) && $btn['title']) ? $btn['title'] : '';
          $btnUrl = (isset($btn['url']) && $btn['url']) ? $btn['url'] : '';
          $btnTarget = (isset($btn['target']) && $btn['target']) ? $btn['target'] : '_self';
          if($title) { ?>
          <div class="flexcol">
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
          <?php } ?>
        <?php } ?>
      </div>
    </section>
    <?php } ?>

    <?php if( $intro_content = get_field('intro_content') ) { ?>
    <section class="intro-content-block">
      <div class="wrapper">
        <?php echo $intro_content ?>
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
        <div class="flexcol titleCol">
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
            <div class="block" style="background-color:<?php echo $bgcolor ?>">
              <?php if ($number) { ?>
                <div class="number"><?php echo $number ?></div>
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

  <?php endwhile; ?>
  </main>
</div>
<?php
get_footer();