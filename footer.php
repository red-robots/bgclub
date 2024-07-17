	</div><!-- #content -->
	<?php
	$siteLogo = get_field('footer_logo','option');   
	?>
	<?php get_template_part('parts/newsletter-widget'); ?>
	<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="footer-inner">
  		<div class="wrapper">
        <div class="footer-flexwrap"> 

    			<?php if($siteLogo) { ?>
    			  <div class="flexcol footer-logo"><img src="<?php echo $siteLogo['url'] ?>" alt="<?php echo $siteLogo['title'] ?>" /></div>
    			<?php } ?>
    			
    			<?php if( has_nav_menu('footer') ) { ?>
    				<div class="flexcol footerNavigation"><?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu') ); ?></div>
    			<?php } ?>

  			  <?php
  				$mailing_address = get_field('mailing_address','option');
  				$phone = get_field('phone','option');
  				$email = get_field('email','option');
  				$mail = get_field('mailing_list_link','option');
  				$contact_info = '';
  				if($mailing_address) {
  					$contact_info .= '<address class="mailing-address">'.$mailing_address.'</address>';
  				}
  				if($phone) {
  					$contact_info .= '<div class="phone">phone: <a href="tel:'.$phone.'">'.$phone.'</a></div>';
  				}
  				if($email) {
  					$contact_info .= '<div class="email">email: <a href="mailto:'.antispambot($email,1).'">'.antispambot($email).'</a></div>';
  				}
    				
  				if($contact_info) { ?>
  				  <div class="flexcol footer-mailing-address">
              <?php echo $contact_info ?>
            </div>
  				<?php } ?>

          <?php 
            $social_media = get_social_media();
            $street_address = get_field('street_address','option');
            if($street_address || $social_media) { ?>
            <div class="flexcol footer-street-address">
              <?php if ($street_address) { ?>
                <address class="street-address"><?php echo $street_address ?></address>
              <?php } ?>

              <?php if($social_media) { ?>
              <div class="footer-social-media">
                <?php foreach ($social_media as $icon) { ?>
                  <a href="<?php echo $icon['url'] ?>" target="_blank" arial-label="<?php echo ucwords($icon['type']) ?>"><i class="<?php echo $icon['icon'] ?>"></i></a> 
                <?php } ?>
              </div> 
              <?php } ?>
            </div>
          <?php } ?>

        </div>
  		</div>
    </div>
	</footer><!-- #colophon -->

</div><!-- #page -->

<div class="modalWrapper">
  <div class="modalContainer">
    <button class="modalCloseBtn"><span class="sr">Close</span></button>
    <div class="modalContent"></div>
  </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
