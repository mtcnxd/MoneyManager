<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Helpers extends Controller
{
    public static function calculatePercentage(float $current, float $last) : float
    {
        $difference = ($last - $current);
        $percentage = ($difference / $current) * 100;
        return number_format($percentage, 2);
    }
}
