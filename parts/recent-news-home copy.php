<?php
$args_featured = array(
  'post_type' => 'post',
  'posts_per_page' => $perpage,
  'post__in' => get_option( 'sticky_posts' ),
  'category__not_in'=> array(17)
);

$featured = get_posts($args_featured);
$args = array(
  'posts_per_page'  => $perpage,
  'post_type'       => 'post',
  'orderby'         => 'date',
  'order'           => 'desc',
  'post_status'     => 'publish',
  'category__not_in'=> array(17)
);
$recent = get_posts($args);

$entries = array();
if($featured) {
  unset($args['orderby']);
  unset($args['order']);

  foreach($featured as $fp) {
    $entries[] = $fp->ID;
  }

  if($recent) {
    $i=count($entries);
    foreach($recent as $r) {
      $entries[$i] = $r->ID;
      $i++;
    }
  }
} else {
  if($recent) {
    foreach($recent as $r) {
      $entries[] = $r->ID;
    }
  }
} 


if($entries) {
  foreach($entries as $k=>$v) {
    if($k >= $perpage) {
      unset($entries[$k]);
    }
  } 
  $args['post__in'] = $entries;
  $news = get_posts($args); ?>
  <div class="recents-posts-feeds feeds-wrapper">
    <ul class="feeds recent-posts">
      <?php foreach ($entries as $pid) { 
        $img = get_field('thumbnail_image', $pid);
        $imageUrl = ($img) ? $img['url'] : '';
        $imgAlt = ($img) ? $img['title'] : '';
        $post_title = get_the_title($pid);
        $page_link = get_permalink($pid);
        ?>
        <li class="feed">
          <div class="inside">
            <div class="text">
              <figure>
                <?php if($imageUrl) { ?>
                  <a href="<?php echo $page_link ?>">
                    <img src="<?php echo $imageUrl?>" alt="<?php echo $imgAlt?>" class="feat-image" />
                    <img src="<?php echo get_stylesheet_directory_uri()?>/assets/img/square.png" alt="" class="resizer" />
                  </a>
                <?php } else { ?>
                  <img src="<?php echo get_stylesheet_directory_uri()?>/assets/img/square.png" alt="" />
                <?php } ?>
              </figure>
              <p class="posttitle"><?php echo $post_title; ?></p>
            </div>
          </div>
        </li>
      <?php } ?>
    </ul>
  </div>
<?php } ?>






