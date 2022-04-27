<?php

namespace App\Models;

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
}