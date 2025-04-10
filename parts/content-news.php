<?php
$post_type = 'post';
$current_id = get_the_ID();
$p_args = array(
	'posts_per_page'=> -1,
	'post_type'		=> $post_type,
	'post_status'	=> 'publish',
	'orderby'       => 'date',       
  	'order'         => 'DESC'
);
$allPOSTS = get_posts($p_args);
$lists = array();
$currentIndex = 0;
if($allPOSTS) {
	foreach($allPOSTS as $k=>$a) {
		$pId = $a->ID;
		$lists[] = $pId;
		if($pId==$current_id) {
			$currentIndex = $k;
		}
	}
}
$next_id = ( isset($lists[$currentIndex+1]) && $lists[$currentIndex+1] ) ? $lists[$currentIndex+1] : '';
$prev_id = ( isset($lists[$currentIndex-1]) && $lists[$currentIndex-1] ) ? $lists[$currentIndex-1] : '';
?>

<main id="main" class="site-main single-post cf" role="main">
	<div class="wrapper">

		<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php
			$thumbID = get_post_thumbnail_id();  
			$thumbinfo = get_post($thumbID);
			$thumb_caption = ( isset($thumbinfo->post_excerpt) ) ? $thumbinfo->post_excerpt : '';
			?>
			
			<?php if ( has_post_thumbnail() ) { ?>
			<div class="feat-image fw">
				<?php the_post_thumbnail('large') ?>
				<?php if ($thumb_caption) { ?>
				<div class="thumb-caption"><?php echo $thumb_caption ?></div>			
				<?php } ?>		
			</div>	
			<?php } ?>

			<header class="post-header">
				<div class="post-date">Posted on: <?php echo get_the_date('m/d/Y') ?></div>
				<h2><?php the_title(); ?></h2>
			</header>

			<div class="entry-content">
				<?php 
				$partner = get_field("partners"); 
				$partner_id = ($partner) ? $partner[0] : '';
				?>
				<?php the_content(); ?>
				<?php if ($partner_id) { ?>
				<div class="about-vendor"><a href="<?php echo get_permalink($partner_id); ?>" class="btn-more">About the Vendor</a></div>
				<?php } ?>
			</div><!-- .entry-content -->

			<?php $bottomText = get_field("news_bottom_text","option"); ?>
			<?php if( $bottomText ) { ?>
			<div class="news-bottom-text"><?php echo $bottomText ?></div>	
			<?php } ?>

			<div class="breadcrumb">
				<div class="inner">
					<?php if ($prev_id) { ?>
						<a href="<?php echo get_permalink($prev_id); ?>" id="prevpost">previous</a>
					<?php } ?>
					<?php if ($prev_id && $next_id) { ?>
						<span>|</span>
					<?php } ?>
					<?php if ($next_id) { ?>
						<a href="<?php echo get_permalink($next_id); ?>" id="nextpost">next</a>
					<?php } ?>
				</div>
			</div>

		</article><!-- #post-## -->
		<?php endwhile;  ?>

		<?php
		/* SIDE BAR */
		$current_id = get_the_ID();
		$posts_per_page = 10;
		$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
		$args = array(
			'posts_per_page'=> $posts_per_page,
			'post_type'		=> $post_type,
			'post_status'	=> 'publish',
			'post__not_in' 	=> array($current_id),
			'paged'			=> $paged,
			'orderby'       => 'date',       
		  	'order'         => 'DESC'
		);

		$all_args = array(
			'posts_per_page'=> -1,
			'post_type'		=> $post_type,
			'post_status'	=> 'publish',
			'post__not_in' 	=> array($current_id),
		);

		$posts = get_posts($args);
		$all = get_posts($all_args);
		$total = ($all) ? count($all) : 0;
		?>
		<aside id="sidebar" class="sidebar-right">
			<?php if ($posts) { ?>
			<div id="widget-articles" class="widget articles">
				<div class="inside cf">
					<h3 class="wtitle"><span>More Articles</span></h3>
					<div id="recentPosts">
						<ul class="recent-posts">
							<?php foreach ($posts as $p) { 
							$id = $p->ID; 
							$title = $p->post_title;
							$link = get_permalink($id);
							$content = strip_tags( $p->post_content );
							$content = ($content) ? shortenText($content,100,' ') : '';
							?>
							<li class="item animated fadeIn">
								<p class="postdate"><?php echo get_the_date('m/d/Y',$id); ?></p>
								<h4><a href="<?php echo $link ?>"><?php echo $title ?></a></h4>
							</li>	
							<?php } ?>
						</ul>
					</div>
				</div>

				<?php 
				$total_pages = ceil($total / $posts_per_page);
				if($paged!=$total_pages) { ?>
				<div class="morediv text-center"><a href="#" id="sbloadmore" data-maxpagenum="<?php echo $total_pages ?>" data-nextpage="<?php echo $paged ?>" class="btnbg">Load More</a></div>
				<?php } else { ?>
				<div class="morediv text-center endpage"><span class="end">No more posts to load.</span></div>
				<?php } ?>

				<?php if ($total_pages > 1){ ?>
				<div id="pagination" class="pagination" style="display:none;">
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
		                echo paginate_links($pagination);
		            ?>
		        </div>
				<?php } ?>
			</div>
			<?php } ?>
			
		</aside>
	</div>
</main>
