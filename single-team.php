<?php
/**
 * The template for displaying all pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bellaworks
 */

get_header(); 
?>

<div id="primary" class="content-area-full content-default page-default-template">
  
  <main id="main" class="site-main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>

      <?php  
        $photo = get_field('photo');
        $job_title = get_field('job_title');
        $office_phone = get_field('office_phone');
        $cellphone = get_field('cellphone');
        $address = get_field('address');
        $info = array($photo,$job_title,$office_phone,$cellphone,$address);
        $column = ( array_filter($info) ) ? 'half':'full';
      ?>
      
      <div class="hero-section">
        <div class="wrapper">
          <div class="titlediv">
            <h1><?php the_title(); ?></h1>
            <?php if ($job_title) { ?>
            <div class="jobtitle"><?php echo $job_title ?></div>  
            <?php } ?>
          </div>
        </div>
      </div>

    
      <div class="teamInfo entry-content <?php echo $column ?>">

        <div class="wrapper">
          <div class="flexwrap">
            <div class="details">
              <div class="teamName" style="display:none">
                <h2><?php the_title(); ?></h2>
                <?php if ($job_title) { ?>
                <div class="jobtitle"><?php echo $job_title ?></div>  
                <?php } ?>
              </div>
        
              <?php the_content(); ?>
            </div>

            <?php if ($column=='half') { ?>
            <div class="photo">
              <?php if ($photo) { ?>
              <figure>
                <img src="<?php echo $photo['url'] ?>" alt="<?php echo $photo['title'] ?>" />
              </figure>  
              <?php } ?>
              <?php if ($office_phone) { ?>
              <div class="info phone">Office Phone: <a href="tel:<?php echo format_phone_number($office_phone) ?>"><?php echo $office_phone ?></a></div>
              <?php } ?>

              <?php if ($cellphone) { ?>
              <div class="info cell">Cell Phone: <a href="tel:<?php echo format_phone_number($cellphone) ?>"><?php echo $cellphone ?></a></div>
              <?php } ?>

              <?php if ($address) { ?>
              <div class="info address">Address: <?php echo $address ?></div>
              <?php } ?>
            </div>  
            <?php } ?>
          </div>
        </div>
      </div>  

		<?php endwhile; ?>

	</main><!-- #main -->
		
</div><!-- #primary -->

<?php
get_footer();
