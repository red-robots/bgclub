<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bellaworks
 */
get_header(); 
global $post;
$slug = $post->post_name;
$content_parts['events'] = 'content-upcoming-events';
$content_parts['about-us'] = 'content-about-us';
?>
<div id="primary" class="content-area-full generic-layout">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

      <?php if ( array_key_exists($slug, $content_parts) ){ ?>

        <div class="hero-section">
          <div class="wrapper">
            <h1><?php the_title(); ?></h1>
          </div>
        </div>
        <?php get_template_part('parts/' . $content_parts[$slug] ); ?>
        
      <?php } else { ?>

        <h1 class="page-title"><span><?php the_title(); ?></span></h1>
			
        <div class="entry-content">
          <?php the_content(); ?>
        </div>  

      <?php } ?>

		<?php endwhile; ?>

	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
