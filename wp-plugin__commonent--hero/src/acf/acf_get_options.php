<?php

namespace andyp\webcomponent_hero\acf;


class acf_get_options
{
    public $results;
    
    public function __construct()
    {
        return $this;
    }

    /**
     * This will get ALL of the repeater options
     */
    public function get($field_name)
    {
        $this->get_options_from_rows($field_name);
        return $this->results;
    }


    /**
     * This will get all of the repeater options and then strip out any that
     * does not have a field that equals the value.
     */
    public function filtered($field_name, $field, $value)
    {
        $this->get_options_from_rows($field_name);
        $this->filter_options($field, $value);
        return $this->results;
    }


    //  ┌─────────────────────────────────────────────────────────────────────────┐
    //  │                                                                         │░
    //  │                                                                         │░
    //  │                            PRIVATE METHODS                              │░
    //  │                                                                         │░
    //  │                                                                         │░
    //  └─────────────────────────────────────────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░


    /**
     * Get ALL values from a field that has rows.
     */
    private function get_options_from_rows($field_name)
    {

        /**
         * If not a repeater-type field, just return the field.
         */
        if (!have_rows($field_name, 'option')) {

            $this->results = get_field($field_name);
            return;
        }

        /**
         * Get the repeater field rows and loop over them.
         */
        while (have_rows($field_name, 'option')) {

            $row = the_row(true);

            $this->results[] = $row;
        }

    }


    /**
     * Loop through the results and unset any whose field does not match the value.
     */
    private function filter_options($field, $value)
    {
        /**
         * Loop through all results.
         */
        foreach($this->results as $key => $result)
        {
            /**
             * If the field matches the value, skip.
             */
            if ($result[$field] == $value)
            {
                continue;
            }

            unset($this->results[$key]);
        }
    }

    
}
