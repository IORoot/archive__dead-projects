<?php

/**
 * BuddyPress - Users Profile
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<!--    <div class="x-item-list-tabs-subnav item-list-tabs no-ajax" id="subnav" role="navigation">-->
<!--        <ul>-->
<!--            --><?php //bp_get_options_nav(); ?>
<!--        </ul>-->
<!--    </div><!-- .item-list-tabs -->




    <?php //do_shortcode('[history-graph]'); ?>
    <?php do_shortcode('[chart-history]'); ?>

    <div class="chart-donut-background">
        <?php do_shortcode('[chart-progress]'); ?>
        <?php do_shortcode('[chart-achievements]'); ?>
        <?php do_shortcode('[chart-distribution]'); ?>
    </div>

    <h2>Watch History Log</h2>
    <?php do_shortcode('[history-log]'); ?>




<?php do_action( 'bp_before_profile_content' ); ?>

<div class="profile" role="main">

<?php switch ( bp_current_action() ) :

	// Edit
	case 'edit'   :
		bp_get_template_part( 'members/single/profile/edit' );
		break;

	// Change Avatar
	case 'change-avatar' :
		bp_get_template_part( 'members/single/profile/change-avatar' );
		break;

	// Compose
	case 'public' :

		// Display XProfile
		if ( bp_is_active( 'xprofile' ) )
			bp_get_template_part( 'members/single/profile/profile-loop' );

		// Display WordPress profile (fallback)
		else
			bp_get_template_part( 'members/single/profile/profile-wp' );

		break;

	// Any other
	default :
		bp_get_template_part( 'members/single/plugins' );
		break;
endswitch; ?>
</div><!-- .profile -->

<?php do_action( 'bp_after_profile_content' ); ?>