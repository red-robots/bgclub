<?php
$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
$perpage = -1;
$post_type = "board";
$taxonomy = "team-department";

$term_args = array(
  'post_type'   => $post_type,
  'taxonomy'    => $taxonomy,
  'hide_empty'  => true
);
$department = get_terms( $term_args );
if($department) { ?>
<div class="boxes-type-container">
  <div class="wrapper">
    <?php foreach ($department as $e) { ?>
      <div class="infogroup">
        <h2 class="section-title"><?php echo $e->name ?></h2>      

        <?php  
        $args = array(
          'post_type'         => $post_type,
          'posts_per_page'    => $perpage,
          'post_status'       => 'publish',
          'tax_query' => array(
            array (
              'taxonomy' => $taxonomy,
              'field' => 'term_id',
              'terms' => array($e->term_id)
            )
          ),
        );
        $entries = new WP_Query($args);
        if ( $entries->have_posts() ) {  $count = $entries->found_posts; ?>
        <div class="team-images-block count-<?php echo $count ?>">
          <div class="flexwrap">
          <?php $i=1; while ( $entries->have_posts() ) : $entries->the_post(); ?>
            <?php  
              $photo = get_field('photo');
              $job_title = get_field('job_title');
              $office_phone = get_field('office_phone');
              $cellphone = get_field('cellphone');
              $address = get_field('address');
              $name = get_the_title();
            ?>
            <div class="infobox">
              <div class="infocontent">
                <?php if ($photo) { ?>
                <figure>
                  <img src="<?php echo $photo['url'] ?>" alt="<?php echo $photo['alt'] ?>" />
                </figure>  
                <?php } ?>

                <div class="name-info">
                  <div class="name"><?php echo $name ?></div>
                  <?php if ($job_title) { ?>
                  <div class="jobtitle">
                    <?php echo $job_title ?>
                  </div>  
                  <?php } ?>
                </div>  
              </div>
            </div>
          <?php $i++; endwhile; wp_reset_postdata(); ?>
          </div>
        </div>
        <?php } ?>
      </div>
    <?php } ?>
  </div>
</div>


<?php } ?>

