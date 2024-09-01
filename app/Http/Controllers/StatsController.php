<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatsController extends Controller
{
    private static array $months = [
        'January' => 0,
        'February' => 0,
        'March' => 0,
        'April' => 0,
        'May' => 0,
        'June' => 0,
        'July' => 0,
        'August' => 0,
        'September' => 0,
        'October' => 0,
        'November' => 0,
        'December' => 0,
    ];

    public function countOfUse()
    {
        $user = Auth::user();

        /** @var \App\Models\User $user */
        $movements = $user->movements()->get();

        $countOfUse = self::$months;

        foreach ($movements as $movement) {
            $month = $movement->created_at->format('F');
            $countOfUse[$month]++;
        }

        return response()->json($countOfUse);
    }
}
