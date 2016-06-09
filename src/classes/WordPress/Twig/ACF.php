<?php
/**
 * Created by PhpStorm.
 * User: rpark
 * Date: 6/8/2016
 * Time: 11:20 PM
 */

namespace Supertheme\WordPress\Twig;


class ACF
{
    /**
    *  This function will return an array containing all the field data for a given field_name
    *
    *  @param $selector string the field name or key
    *  @param $post_id mixed the post_id of which the value is saved against
    *  @param $format_value boolean whether or not to format the field value
    *  @param $load_value boolean whether or not to load the field value
    *  @return $field array
    */
    public function get_field_object($selector, $post_id = false, $format_value = true, $load_value = true)
    {
        return get_field_object($selector, $post_id, $format_value, $load_value);
    }

    /**
    *  This function will return an array containing all the custom field objects for a specific post_id.
    *  The function is not very elegant and wastes a lot of PHP memory / SQL queries if you are not using all the fields / values.
    *
    *  @param $post_id mixed the post_id of which the value is saved against
    *  @param $format_value boolean whether or not to format the field value
    *  @param $load_value boolean whether or not to load the field value
    *  @return array associative array where field name => field
    */
    public function get_field_objects($post_id = false, $format_value = true, $load_value = true)
    {
        return get_field_objects($post_id, $format_value, $load_value);
    }

    /**
    *  This function will return a custom field value for a specific field name/key + post_id.
    *  There is a 3rd parameter to turn on/off formating. This means that an image field will not use
    *  its 'return option' to format the value but return only what was saved in the database
    *
    *  @param $selector string the field name or key
    *  @param $post_id mixed the post_id of which the value is saved against
    *  @param $format_value boolean whether or not to format the value as described above
    *  @return mixed
    */
    public function get_field($field_name, $post_id = false, $format_value = true)
    {
        return get_field($field_name, $post_id, $format_value);
    }


    /**
    *  This function will return an array containing all the custom field values for a specific post_id.
    *  The function is not very elegant and wastes a lot of PHP memory / SQL queries if you are not using all the values.
    *
    *  @param $post_id mixed the post_id of which the value is saved against
    *  @param $format_value boolean whether or not to format the field value
    *  @return array associative array where field name => field value
    */
    public function get_fields($post_id = false, $format_value = true)
    {
        return get_fields($post_id, $format_value);
    }

    /**
     * This function will return the current loop count within a have_rows() loop.
     * @return int
     */
    public function get_row_index()
    {
        return get_row_index();
    }

    /**
    *  This function will return a string representation of the current row layout within a 'have_rows' loop
    *
    *  @return	(string)
    */
    public function get_row_layout()
    {
        get_row_layout();
    }

    /**
     * This function will return an array containing all sub field values for the current row within a have_rows() loop.
     * @param bool $format_values whether or not to format the value loaded from the db. Defaults to false
     * @return array|bool|mixed|void
     */
    public function get_row($format_values = false)
    {
        return get_row($format_values);
    }


    /**
    *  This function is used inside a 'has_sub_field' while loop to return a sub field object
     *
    *  @param $child_name string the field name
    *  @return array
    */
    public function get_sub_field_object($selector, $format_value = true, $load_value = true)
    {
        return get_sub_field_object($selector, $format_value, $load_value);
    }

    /**
    *  This function is used inside a 'has_sub_field' while loop to return a sub field value
     *
    *  @param $field_name string the field name
    *  @return mixed
    */
    public function get_sub_field($sub_field_name, $format_value = true)
    {
        return get_sub_field($sub_field_name, $format_value);
    }

    /**
    *  This function will instantiate a global variable containing the rows of a repeater or flexible content field,
    *  afterwhich, it will determine if another row exists to loop through
    *
    *  @param $field_name string the field name
    *  @param $post_id mixed the post_id of which the value is saved against
    *  @return boolean
    */
    public function have_rows($field_name, $post_id = false)
    {
        return have_rows($field_name, $post_id);
    }
}