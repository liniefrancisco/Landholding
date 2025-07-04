<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('custom_format_date')) {
    function custom_format_date($date)
    {
        return date('F j, Y', strtotime($date));
    }
}
