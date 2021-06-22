<?php

/**
 * Add styles.
 */
wp_register_style( 'andyp_mec_modal_css', ANDYP_MEC_SINGLE_PAGE_PATH . '/src/sass/style.css' );
wp_enqueue_style(  'andyp_mec_modal_css');

/** no direct access **/
defined('MECEXEC') or die();

$single = new MEC_skin_single();
wp_enqueue_style('mec-lity-style', $this->main->asset('packages/lity/lity.min.css'));
wp_enqueue_script('mec-lity-script', $this->main->asset('packages/lity/lity.min.js'));

$booking_options = get_post_meta(get_the_ID(), 'mec_booking', true);

//Compatibility with Rank Math
$rank_math_options = '';
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if(is_plugin_active('schema-markup-rich-snippets/schema-markup-rich-snippets.php')) $rank_math_options = get_post_meta(get_the_ID(), 'rank_math_rich_snippet', true);

if(!is_array($booking_options)) $booking_options = array();

$bookings_limit_for_users = isset($booking_options['bookings_limit_for_users']) ? $booking_options['bookings_limit_for_users'] : 0;
$display_reason = get_post_meta(get_the_ID(), 'mec_display_cancellation_reason_in_single_page', true);
?>

<div class="mec-wrap <?php echo $event_colorskin; ?> clearfix <?php echo $this->html_class; ?>" id="mec_skin_<?php echo $this->uniqueid; ?>">
    <?php do_action('mec_top_single_event' , get_the_ID()); ?>
    <article class="row mec-single-event">

        <?php include(__DIR__.'/src/components/page/breadcrumbs.php'); ?>
        
        <div class="col-md-12">
            <?php include(__DIR__.'/src/components/page/images.php'); ?>
            <?php include(__DIR__.'/src/components/meta_box.php'); ?>

        </div>

        <div class="col-md-1"></div>
        <div class="col-md-10">

            <?php include(__DIR__.'/src/components/page.php'); ?>

            <?php if(!is_active_sidebar('mec-single-sidebar')) {
                include(__DIR__.'/src/components/non_mec_sidebar.php');
            } else {
                include(__DIR__.'/src/components/mec_sidebar.php');
            }

            include(__DIR__.'/src/components/dynamic_sidebar.php'); ?>
        </div>
        <div class="col-md-1"></div>
    </article>

    <?php $this->display_related_posts_widget($event->ID); ?>
</div>


<?php if ( $rank_math_options != 'event') do_action('mec_schema', $event); ?>

<?php include(__DIR__.'/src/components/js/mec.php'); ?>