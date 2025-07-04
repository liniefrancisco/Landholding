<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('number_to_words')) {
    function number_to_words($number) {
        $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        return $f->format($number);
    }
}



