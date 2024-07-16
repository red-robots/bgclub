<?php if ( do_shortcode('[upcoming_events show="-1"]') ) { ?>
<div class="all-events-list all-upcoming-events show-all">
  <?php echo do_shortcode('[upcoming_events show="-1" all="1"]'); ?>
</div>
<?php } ?>


<?php if ( do_shortcode('[past_events show="-1" all="1"]') ) { ?>
<div class="all-events-list past-events-events show-all">
  <?php echo do_shortcode('[past_events show="-1" all="1"]'); ?>
</div>
<?php } ?>