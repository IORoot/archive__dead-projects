<?php

/*
 * Generate Coupon Class
 *
 * This class will insert a properly formated coupon object into the database.
 * The object should be created from the 'create_coupon' function below.
 *
 */
class TBGenerateCoupon
{

    /**
     * @param \TeamBooking\Promotions\Promotion $data
     *
     * @return mixed
     */
    public function __construct($data)
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'teambooking_promotions';
        $class = 'coupon';
        $created = current_time('mysql');
        $data_object = serialize($data);

        // INSERT INTO DATABASE!

        $wpdb->insert($table_name, array(
            'created'     => $created,
            'class'       => $class,
            'start_time'  => date('Y-m-d H:i:s', $data->getStartTime()),
            'end_time'    => date('Y-m-d H:i:s', $data->getEndTime()),
            'data_object' => $data_object,
        ));

        return;
    }
}