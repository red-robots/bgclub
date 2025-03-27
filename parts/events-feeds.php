<?php
$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
$current_date = date('Y-m-d H:i:s', strtotime(WP_CURRENT_TIME));
$current_time = date('H:i:s', strtotime(WP_CURRENT_TIME));


if( $perpage== -1 ) {
  
  $args = array(
    'post_type'         => 'events',
    'posts_per_page'    => $perpage,
    'post_status'       => 'publish'
  );


  if($show_all=='past') {

    $args['meta_query'] = array(
      [
        'key'       => 'start_date',
        'value'     => $current_date,
        'compare'   => '<',
        'type'      => 'DATE',
      ]
    );

    $args['meta_key'] = 'start_date';
    $args['orderby']  = 'meta_value_num';
    $args['order']    = 'DESC';
    // $args['order'] = 'ASC';

  } else {

    $args['meta_query'] = array(
        [
          'key'       => 'start_date',
          'compare'   => '>=',
          'value'     => $current_date,
          'type'      => 'DATE',
        ]
    );

    $args['meta_key'] = 'start_date';
    $args['orderby'] = 'meta_value_num';
    $args['order'] = 'ASC';

    // $args = array(
    //   'post_type'         => 'events',
    //   'posts_per_page'    => $perpage,
    //   'post_status'       => 'publish',
    //   'meta_query'        => array(
    //     [
    //       'key'       => 'start_date',
    //       'compare'   => '>=',
    //       'value'     => $current_date,
    //       'type'      => 'DATE',
    //     ]
    //   ),
    //   'meta_key'=>'start_date',
    //   'orderby'=>'meta_value_num',
    //   'order'=>'ASC'
    // );

  }

} else {

  $args = array(
    'post_type'         => 'events',
    'posts_per_page'    => $perpage,
    'paged'             => $paged,
    'post_status'       => 'publish',
    'meta_query'        => array(
      [
        'key'       => 'start_date',
        'compare'   => '>=',
        'value'     => $current_date,
        'type'      => 'DATE',
      ]
    ),
    'meta_key'=>'start_date',
    'orderby'=>'meta_value_num',
    'order'=>'ASC'
  );

}
$entries = new WP_Query($args);
if ( $entries->have_posts() ) {  
  $entries_total = $entries->found_posts;
  ?>
  <div class="newsfeeds-wrapper events-feeds">
    <div class="news">
      <?php $i=1; while ( $entries->have_posts() ) : $entries->the_post();  
        //$img = get_field('thumbnail_image');
        $post_id = get_the_ID();
        $thumbnail_id = get_post_thumbnail_id($post_id);
        $thumbnailAlt = get_the_title($thumbnail_id);
        $img = wp_get_attachment_image_src($thumbnail_id,'large');
        $imageUrl = ($img) ? $img[0] : '';
        $imgAlt = ($thumbnailAlt) ? $thumbnailAlt : '';
        $content = get_the_content();
        $content = ($content) ? strip_tags(strip_shortcodes($content))  : '';
        $excerpt = ($content) ? shortenText( $content, 200, ".", "...") : "";

        $today = date('Y-m-d', strtotime(WP_CURRENT_TIME));
        $start_date = get_field('start_date', $post_id);  
        $event_date = '';
        if($start_date) {
          $sDate = date('Y-m-d', strtotime($start_date));
          if($sDate==$today) {
            $event_date = "Now - " . date('F d, Y', strtotime($start_date));
          } else {
            $event_date = date('l, F d, Y', strtotime($start_date));
          }
        }

        $timings = array();
        if( $start_time = get_field('start_time', $post_id) ) {
          $stime = date('g:ia', strtotime($start_time));
          // if (strpos($stime, ':00') !== false) {
          //   $stime = str_replace(':00','',$stime);
          // }
          $timings[] = $stime;
        }
        if( $end_time = get_field('end_time', $post_id) ) {
          $etime = date('g:ia', strtotime($end_time));
          // if (strpos($etime, ':00') !== false) {
          //   $etime = str_replace(':00','',$etime);
          // }
          $timings[] = $etime;
        }
        $time_range = '';
        if($timings) {
          $time_range = implode(' - ', $timings);
          if($event_date) {
            $event_date .= ' <div class="event-times">' . $time_range . '</div>';
          }
        }

        $end_date = get_field('end_date', $post_id); 
        $end_date = ($end_date) ? date('F d, Y', strtotime($end_date)) : '';

        if($start_date && $end_date) {
          $stDate = strtotime($start_date);
          $endDateStr = strtotime($end_date);
          $nowTime = strtotime(WP_CURRENT_TIME);
          $event_date = date('F d, Y', strtotime($start_date));
          $event_date .= ' to ' . $end_date;

          if($nowTime < $endDateStr) {
            $event_date = 'Now through ' . $end_date;
          }
          
          if($is_past_events) {
            if($stDate < $nowTime) {
              if($time_range) {
                $event_date = date('l, F d, Y', strtotime($start_date))  . ' <div class="event-times">' . $time_range . '</div>';
              } else {
                $event_date = date('l, F d, Y', strtotime($start_date));
              }
            }
          }

          if($stDate==$endDateStr) {
            if($time_range) {
              $event_date = date('l, F d, Y', strtotime($start_date)) . ' <div class="event-times">' . $time_range . '</div>';
            } else {
              $event_date = date('l, F d, Y', strtotime($start_date));
            }
          }


          // $start_time = get_field('start_time');
          // $end_time = get_field('end_time');
          // $event_times = array($start_time, $end_time);
          // if( $times = array_filter($event_times) ) {
          //   $event_times = implode(' - ', $times);
          //   $event_date .= '<div class="event-times">'.$event_times.'</div>';
          // }

        }

        $cta_buttons = get_field('buttons');
        $buttons_html = '';
        if($cta_buttons) {
          foreach($cta_buttons as $a) {
            $btn = $a['button'];
            $btnName = ( isset($btn['title']) && $btn['title'] ) ? $btn['title'] : '';
            $btnLink = ( isset($btn['url']) && $btn['url'] ) ? $btn['url'] : '';
            $btnTarget = ( isset($btn['target']) && $btn['target'] ) ? $btn['target'] : '_self';
            if($btnLink && $btnName) {
              $buttons_html .= '<div class="button-block"><a href="'.$btnLink.'" target="'.$btnTarget.'" class="button-green">'.$btnName.'</a></div>';
            }
          }
        }
        if($buttons_html) {
          $buttons_html = '<div class="readmore button-group">'.$buttons_html.'</div>';
        }
        ?>
        <article class="post-item event-item" id="post-item-<?php echo get_the_ID() ?>">
          <div class="inside">

            <?php if ( isset($show_all) && $show_all ) { ?>

              <div class="wrap">
                <?php if($imageUrl) { ?>
                <figure class="imagecol fxcol">
                  <img src="<?php echo $imageUrl?>" alt="<?php echo $imgAlt?>" class="post-image" />
                </figure>
                <?php } ?>

                <div class="textcol fxcol">
                  <div class="event-title">
                    <h2 class="post-title"><?php echo get_the_title()?></h2>
                    <?php if($event_date) { ?>
                    <div class="event-date"><?php echo $event_date?></div>
                    <?php } ?>
                  </div>
                  
                  <div class="excerpt"><?php the_content(); ?></div>
                </div>
              </div>

              <?php echo $buttons_html; ?>

            <?php } else { ?> 
              <div class="textcol fxcol">
                <div class="event-title">
                  <h2 class="post-title"><?php echo get_the_title()?></h2>
                  <?php if($event_date) { ?>
                  <div class="event-date"><?php echo $event_date?></div>
                  <?php } ?>
                </div>
                
                <div class="excerpt"><?php the_content(); ?></div>

                <?php echo $buttons_html; ?>
              </div>

              <?php if($imageUrl) { ?>
              <figure class="imagecol fxcol">
                <a href="<?php echo get_site_url() ?>/events/?pid=<?php echo get_the_ID() ?>">
                  <img src="<?php echo $imageUrl?>" alt="<?php echo $imgAlt?>" class="post-image" />
                </a>
              </figure>
              <?php } ?>
            <?php } ?>


          </div>
        </article>
      <?php $i++; endwhile; wp_reset_postdata(); ?>
    </div>

    
      <?php
      $total_pages = $entries->max_num_pages;
      if ($entries_total > $total_pages) { ?>
      <div id="pagination" class="pagination-wrapper">
        <?php
        $pagination = array(
            'base' => @add_query_arg('pg','%#%'),
            'format' => '?paged=%#%',
            'current' => $paged,
            'total' => $total_pages,
            'prev_text' => __( '&laquo;', 'red_partners' ),
            'next_text' => __( '&raquo;', 'red_partners' ),
            'type' => 'plain'
        );
        echo paginate_links($pagination); ?>
      </div>
      <?php } ?>
    
  </div>
<?php } ?>


