<?php

namespace App\Http\Traits;

trait Utils
{

protected function convertToType($string)
    {
        if (is_numeric($string)) {
            if (strpos($string, '.') !== false) {
                return floatval($string);
            } else {
                return intval($string);
            }
        } elseif (strtolower($string) === 'true') {
            return true;
        } elseif (strtolower($string) === 'false') {
            return false;
        } else {
            return strval($string);
        }
    }
}
