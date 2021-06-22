<?php

namespace TeamBooking\Shortcodes;
defined('ABSPATH') or die('No script kiddies please!');

use TeamBooking\Functions,
    TeamBooking\Actions,
    TeamBooking\Database;

/**
 * Class Cancellation
 *
 * @author VonStroheim
 */
class Cancellation
{
    /**
     * @param $atts
     *
     * @return mixed
     */
    public static function render($atts)
    {
        // Set attributes
        extract(shortcode_atts(array(
            'read_only' => FALSE,
        ), $atts, 'tb-cancellation'));

        if (!defined('TBK_RESERV_SHORTCODE_FOUND')) {
            define('TBK_RESERV_SHORTCODE_FOUND', TRUE);
        }

        if (!wp_script_is('tb-frontend-script', 'registered')) {
            Functions\registerFrontendResources();
        }

        if (!isset($_GET['id']) || !isset($_GET['token'])) {
            wp_redirect(home_url(), 301);
            exit;
        }

        Functions\enqueueFrontendResources();
        wp_enqueue_style('tb-api-css', TEAMBOOKING_URL . 'css/api-response.css', array(), filemtime(TEAMBOOKING_PATH . 'css/api-response.css'));
        $reservation = Database\Reservations::getById($_GET['id']);

        if ($reservation) {
            $service = Database\Services::get($reservation->getServiceId());
            if (!$service->getSettingsFor('customer_cancellation') || $service->getClass() === 'unscheduled') {
                wp_redirect(home_url(), 301);
                exit;
            }
        }

        if (!$reservation) {
            $content = __('Reservation not found', 'team-booking');
        } elseif ($reservation->getToken() !== $_GET['token']) {
            $content = __('Reservation not found', 'team-booking');
        } else {
            $content = '<h1>' . sprintf(esc_html__('Reservation %s', 'team-booking'), '#' . $reservation->getDatabaseId(TRUE)) . '</h1>';
            if (isset($_GET['success'])) {
                $content .= '<h2>'
                    . esc_html__('Reservation successfully cancelled!', 'team-booking')
                    . '</h2>';
            } elseif ($reservation->isCancelled()) {
                $content .= '<h2>'
                    . esc_html__('This reservation is cancelled already!', 'team-booking')
                    . '</h2>';
            } else {
                $now = current_time('timestamp', TRUE);
                if ($now + $service->getSettingsFor('cancellation_allowed_until') < $reservation->getStart()) {
                    $ok_link = admin_url() . 'admin-ajax.php?action=teambooking_rest_api&operation=cancel&id='
                        . $reservation->getDatabaseId()
                        . '&checksum=' . $reservation->getToken();
                    $content .= self::showConfirmation(__('Do you want to cancel this reservation?', 'team-booking'), $ok_link, $reservation);
                } else {
                    $content .= '<h2>'
                        . esc_html__('This reservation can no longer be cancelled!', 'team-booking')
                        . '</h2>';
                }
            }
        }

        ob_start();

        echo Actions\api_page_main_content('<div class="tbk-api-wrapper">' . $content . '</div>');

        return ob_get_clean();
    }

    public static function showConfirmation($question_text, $ok_link, \TeamBooking_ReservationData $reservation)
    {
        $timezone   = new \DateTimeZone(Functions\parse_timezone_aliases($reservation->getCustomerTimezone()));
        $when_value = Functions\dateFormatter($reservation->getStart(), $reservation->isAllDay(), $timezone);
        $service    = Database\Services::get($reservation->getServiceId());
        ob_start();
        ?>
        <h2 class="entry-title"><?= esc_html($question_text) ?></h2>
        <p>
            <strong><?= $reservation->getServiceName(TRUE) ?></strong>
            <?php printf(esc_html__('on %1$s at %2$s', 'team-booking'),
                '<strong>' . $when_value->date . '</strong>',
                '<strong>' . $when_value->time . '</strong>'
            ); ?>
            (<?= str_replace('_', ' ', $timezone->getName()) ?>)
        </p>

        <?php if ($service->getSettingsFor('cancellation_reason_allowed')) { ?>
        <div>
            <p><?= esc_html__('If yes, please tell us why', 'team-booking') ?></p>
            <p><textarea class="cancellation-reason" style="width: auto"></textarea></p>
        </div>
        <script>
            jQuery(document).ready(function () {
                jQuery('.button.confirm').on('click keypress', function (e) {
                    if (e.which == 13 || e.which == 32 || e.which == 1) {
                        var reason = jQuery('.cancellation-reason').val();
                        if (reason.length !== 0) {
                            e.preventDefault();
                            jQuery(this).attr("href", jQuery(this).attr("href") + '&reason=' + reason);
                            window.location.href = jQuery(this).attr("href");
                        }
                    }
                })
            });
        </script>
    <?php } ?>
        <div class="buttons">
            <a class="button confirm" href="<?= $ok_link ?>">
                <?= esc_html__('yes', 'team-booking') ?>
            </a>
            <a class="button deny" href="<?= site_url() ?>">
                <?= esc_html__('no', 'team-booking') ?>
            </a>
        </div>
        <?php
        return ob_get_clean();
    }
}