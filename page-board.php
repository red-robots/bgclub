<?php
/**
 * Template Name: Board
 */

get_header(); ?>

<div id="primary" class="content-area-full team-page-template">
  <main id="main" class="site-main wrapper-small" role="main">
    <?php while ( have_posts() ) : the_post(); ?>
      <div class="hero-section">
        <div class="wrapper">
          <h1><?php the_title(); ?></h1>
        </div>
      </div>
      <?php if ( get_the_content() ) { ?>
      <section class="entry-content"><?php the_content(); ?></section>
      <?php } ?>
    <?php endwhile; ?>

    <?php get_template_part('parts/team-board'); ?>

  </main>
</div>

<?php
get_footer();
