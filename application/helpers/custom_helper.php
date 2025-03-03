<?php
defined('BASEPATH') or exit('No direct script access allowed');

function number_to_words($number)
{
    $ones = array(
        0 => "Zero",
        1 => "One",
        2 => "Two",
        3 => "Three",
        4 => "Four",
        5 => "Five",
        6 => "Six",
        7 => "Seven",
        8 => "Eight",
        9 => "Nine",
    );

    $tens = array(
        10 => "Ten",
        11 => "Eleven",
        12 => "Twelve",
        13 => "Thirteen",
        14 => "Fourteen",
        15 => "Fifteen",
        16 => "Sixteen",
        17 => "Seventeen",
        18 => "Eighteen",
        19 => "Nineteen",
        20 => "Twenty",
        30 => "Thirty",
        40 => "Forty",
        50 => "Fifty",
        60 => "Sixty",
        70 => "Seventy",
        80 => "Eighty",
        90 => "Ninety",
    );

    $divisors = array(
        1000000 => 'Million',
        1000 => 'Thousand',
        100 => 'Hundred',
    );

    if ($number < 10) {
        return $ones[$number];
    } elseif ($number < 20) {
        return $tens[$number];
    } elseif ($number < 100) {
        $tens_digit = floor($number / 10) * 10;
        $ones_digit = $number % 10;
        return $tens[$tens_digit] . ($ones_digit > 0 ? ' ' . $ones[$ones_digit] : '');
    } elseif ($number < 1000) {
        $hundreds_digit = floor($number / 100);
        $remaining = $number % 100;
        return $ones[$hundreds_digit] . ' Hundred' . ($remaining > 0 ? ' and ' . number_to_words($remaining) : '');
    } else {
        foreach ($divisors as $divisor => $divisor_word) {
            if ($number >= $divisor) {
                $quotient = floor($number / $divisor);
                $remainder = $number % $divisor;
                return number_to_words($quotient) . ' ' . $divisor_word . ($remainder > 0 ? ' ' . number_to_words($remainder) : '');
            }
        }
    }

    return "Number not supported";
}
