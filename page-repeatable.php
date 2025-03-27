<?php
/**
 * Template Name: Flexible Content
 */
get_header(); ?>
<div id="primary" class="content-area-full generic-layout">
  <main id="main" class="site-main" role="main">
    <?php while ( have_posts() ) : the_post(); ?>
      <div class="hero-section">
        <div class="wrapper">
          <h1><?php the_title(); ?></h1>
        </div>
      </div>
      <?php get_template_part('parts/repeatable-blocks'); ?>
    <?php endwhile; ?>
  </main>
</div>
<?php
get_footer();