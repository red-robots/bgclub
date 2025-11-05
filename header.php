<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php if ( is_singular(array('post')) ) { 
global $post;
$post_id = $post->ID;
$thumbId = get_post_thumbnail_id($post_id); 
$featImg = wp_get_attachment_image_src($thumbId,'full'); ?>
<!-- SOCIAL MEDIA META TAGS -->
<meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
<meta property="og:url"   content="<?php echo get_permalink(); ?>" />
<meta property="og:type"  content="article" />
<meta property="og:title" content="<?php echo get_the_title(); ?>" />
<meta property="og:description" content="<?php echo (get_the_excerpt()) ? strip_tags(get_the_excerpt()):''; ?>" />
<?php if ($featImg) { ?>
<meta property="og:image" content="<?php echo $featImg[0] ?>" />
<?php } ?>
<!-- end of SOCIAL MEDIA META TAGS -->
<?php } ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Manrope:wght@200..800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<?php
$homepageLogo = get_field('homepage_logo','option');
$subPageLogo = get_field('subpage_logo','option');
?>
<script>
const siteName = '<?php echo get_bloginfo('name') ?>';
const assetsDir = '<?php echo get_stylesheet_directory_uri() ?>/assets/img';
const siteURL = '<?php echo get_site_url() ?>';
const currentPageId = <?php echo (is_page()) ? get_the_ID():"''"?>;
const params={};location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi,function(s,k,v){params[k]=v});
</script>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php
  get_template_part('parts/announcement');

  $donate = get_field('donate_link','option');
?>

<div id="page" class="site cf">
  <div id="overlay"></div>
  <a class="skip-link sr" href="#content"><?php esc_html_e( 'Skip to content', 'bellaworks' ); ?></a>
  <header id="masthead" class="site-header">
    <div class="wrapper">
      <div class="header-inner">
      <?php if ( has_custom_logo() ) { ?>
          <div class="site-logo"><?php the_custom_logo(); ?></div>
        <?php } ?>

        <a href="#" id="menu-toggle" class="menu-toggle <?php echo ($donate) ? 'has-donate-btn' : ''; ?>" aria-label="Menu Toggle"><span class="sr">Menu</span><span class="bar"></span></a>

        <div class="navOverlay"></div>
        <nav id="site-navigation" class="main-navigation <?php echo ($donate) ? 'has-donate-btn' : ''; ?>" role="navigation">
          <?php
          wp_nav_menu(
            array(
              'theme_location'  => 'primary',
              'menu_class'      => 'menu-wrapper',
              'container_class' => 'primary-menu-container',
              'items_wrap'      => '<ul id="primary-menu-list" class="%2$s">%3$s</ul>',
              'fallback_cb'     => false,
            )
          );
          ?>
        </nav>
        <?php 
          $donate_button_text = (isset($donate['title']) && $donate['title']) ? $donate['title'] : '';
          $donate_button_link = (isset($donate['url']) && $donate['url']) ? $donate['url'] : '';
          $donate_button_target = (isset($donate['target']) && $donate['target']) ? $donate['target'] : '_self';

          if($donate_button_text && $donate_button_link) {
        ?>
          <div class="donate-btn">
            <a href="<?php echo $donate_button_link; ?>" target="<?php echo $donate_button_target; ?>"><?php echo $donate_button_text; ?></a>
          </div>
        <?php } ?>
      </div>
    </div>
  </header>


  <div id="content" class="site-content">
