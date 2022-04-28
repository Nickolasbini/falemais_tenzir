<?php

namespace App\Helpers;

class PercentageHandler
{
    /**
     * Calculates the increase of sent value by sent percentage 
     *
     * @param  int   the value to increase
     * @param  int   the percentage to use
     * @return float
     */
    public static function increaseValueByPercentage($value, $percentage)
    {   
        if($percentage < 1 || $value < 0.01)
            return $value;
        $increasedValue = ($value / 100) * $percentage;
        return $value + $increasedValue;
    }

    /**
     * Formats sent value to match currency
     *
     * @param  int    the value to format
     * @param  string the currency type
     * @return string
     */
    public static function formatValue($value, $currency = 'R$')
    {   
        if($value < 0.1)
            return $value;
        return $currency . number_format((float)$value, 2, ',', ' ');
    }
}