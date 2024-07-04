<?php
$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
$perpage = -1;
$post_type = "team";
$taxonomy = "team-department";


$parent_term_id = getParentTermId('board');
// $term_args = array(
//   'post_type'   => $post_type,
//   'parent'      => $parent_term_id,
//   'taxonomy'    => $taxonomy,
//   'hide_empty'  => true
// );


$term_args = array(
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_query' => array(
        'relation' => 'OR',
        array(
            'key' => 'team_order',
            'compare' => 'NOT EXISTS'
        ),
        array(
            'key' => 'team_order',
            'value' => 0,
            'compare' => '>='
        )
    ),
    'hide_empty' => true,
    'parent' => $parent_term_id
);
$department = get_terms( $taxonomy, $term_args );

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
              <a href="javascript:void(0)" data-href="<?php echo get_permalink(); ?>" class="infocontent infolink popupinfo">
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
              </a>
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

