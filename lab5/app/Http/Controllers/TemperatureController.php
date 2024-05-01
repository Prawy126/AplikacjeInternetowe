<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemperatureController extends Controller
{
    public function ctf(?float $c = null){
    if($c===null){
        return "Brak wartości";
    }else{
        $c = floatval($c);
        $f = $c * 9 / 5 + 32;
        return number_format($c, 1, '.', '') . "°C to " . number_format($f, 1, '.', '') . "°F";

    }


    }

}
