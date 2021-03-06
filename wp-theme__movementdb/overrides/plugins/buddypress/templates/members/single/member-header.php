<?php

/**
 * BuddyPress - Users Header
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

    <?php do_action( 'bp_before_member_header' ); ?>


        <div id="item-header-avatar">
            <a href="<?php bp_displayed_user_link(); ?>">
                <?php
                    $avatarArgs = array(
                        'type' => 'full',
                        'html' => true,
                        'width' => 400,
                        'height' => 400
                    );
                    bp_displayed_user_avatar( $avatarArgs );

                ?>
            </a>
        </div><!-- #item-header-avatar -->



        <div id="item-header-content">

            <div class="x-item-header-title"><?php echo x_buddypress_get_the_title(); ?></div>

            <?php if ( bp_is_active( 'activity' ) && bp_activity_do_mentions() ) : ?>
                <h2 class="user-nicename cfc-b-tx">@<?php bp_displayed_user_mentionname(); ?></h2>
            <?php endif; ?>

            <div class="mycred-balance">
                Total Points: [profile-point-count]
            </div>

            <?php
                // If the page is the 'dashboard' page, then show all badges.
                if (bp_is_user_profile()) {
                    do_action( 'bp_before_member_header_meta' );
                }
            ?>

            <div id="item-meta">

                <?php if ( bp_is_active( 'activity' ) ) : ?>

                    <div id="latest-update">

                        <?php bp_activity_latest_update( bp_displayed_user_id() ); ?>

                    </div>

                <?php endif; ?>

                <div id="item-buttons">

                    <?php do_action( 'bp_member_header_actions' ); ?>

                </div><!-- #item-buttons -->

                <?php
                /***
                 * If you'd like to show specific profile fields here use:
                 * bp_member_profile_data( 'field=About Me' ); -- Pass the name of the field
                 */
                do_action( 'bp_profile_header_meta' );

                ?>

            </div><!-- #item-meta -->

        </div><!-- #item-header-content -->

    <?php do_action( 'bp_after_member_header' ); ?>

    <?php do_action( 'template_notices' ); ?>