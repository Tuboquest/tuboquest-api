<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function countOfUse()
    {
        return response()->json([
            'Janvier' => 100,
            'Février' => 200,
            'Mars' => 300,
            'Avril' => 400,
            'Mai' => 500,
            'Juin' => 600,
            'Juillet' => 700,
            'Août' => 800,
            'Septembre' => 900,
            'Octobre' => 1000,
            'Novembre' => 1100,
            'Décembre' => 1200,
        ]);
    }
}
