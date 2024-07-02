<?php
/**
 * Template Name: Team
 */

get_header(); ?>

<div id="primary" class="content-area-full team-page-template">
  <main id="main" class="site-main wrapper-small" role="main">
    <?php while ( have_posts() ) : the_post(); ?>
      
      <?php if ( get_the_content() ) { ?>
      <section class="entry-content"><?php the_content(); ?></section>
      <?php } ?>

    <?php endwhile; ?>  
  </main>
</div>

<?php
get_footer();
