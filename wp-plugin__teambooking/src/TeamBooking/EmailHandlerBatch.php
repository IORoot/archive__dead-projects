<?php

namespace TeamBooking;
defined('ABSPATH') or die('No script kiddies please!');

/**
 * Class EmailHandlerBatch
 *
 * @author VonStroheim
 * @since  2.5.0
 */
class EmailHandlerBatch
{
    private static $instances = array();

    /**
     * @param EmailHandler $emailHandler
     */
    public static function add(EmailHandler $emailHandler)
    {
        self::$instances[ $emailHandler->getType() ][ $emailHandler->getServiceId() ][ $emailHandler->getFromAddress() ][] = $emailHandler;
    }

    /**
     * Send a single e-mail message for each type-service-sender combination
     */
    public static function send()
    {
        foreach (self::$instances as $type => $instances) {
            foreach ($instances as $service_id => $instances_2) {
                foreach ($instances_2 as $from => $items) {
                    /** @var $model EmailHandler */
                    $model = reset($items);
                    $bodies = array();
                    foreach ($items as $item) {
                        /** @var $item EmailHandler */
                        $bodies[] = $item->getBody();
                    }
                    $model->setBody(Toolkit\findAndReplicateParts($bodies));
                    $model->setBatch(FALSE);
                    $model->send();
                }
            }
        }
        self::$instances = array();
    }

}
