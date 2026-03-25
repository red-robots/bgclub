<?php
/**
 * Template Name: News
 */

get_header(); 
global $post;
$slug = $post->post_name;
?>

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

		<?php include( locate_template('parts/news-listing.php') ); ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
