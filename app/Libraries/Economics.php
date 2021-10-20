<?php

namespace App\Libraries;

trait Economics
{
    /**
     * Round up to specified number of decimal places
     * @param float $float The number to round up
     * @param int $dec How many decimals
     */
    public function roundup($float, $dec = 1)
    {
        if ($dec == 0) {
            if ($float < 0) {
                return floor($float);
            } else {
                return ceil($float);
            }
        } else {
            $d = pow(10, $dec);
            if ($float < 0) {
                return floor($float * $d) / $d;
            } else {
                return ceil($float * $d) / $d;
            }
        }
    }

    /**
     * Round down to specified number of decimal places
     * @param float $float The number to round down
     * @param int $dec How many decimals
     */
    public function rounddown($float, $dec = 1)
    {
        if ($dec == 0) {
            if ($float < 0) {
                return ceil($float);
            } else {
                return floor($float);
            }
        } else {
            $d = pow(10, $dec);
            if ($float < 0) {
                return ceil($float * $d) / $d;
            } else {
                return floor($float * $d) / $d;
            }
        }
    }
}
