<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatsController extends Controller
{
    public function countOfUse()
    {
        $user = Auth::user();

        /** @var \App\Models\User $user */
        $movements = $user->movements();

        $months = $movements->get()->groupBy(function ($movement) {
            return $movement->created_at->format('F');
        });

        $countOfUse = $months->map(function ($month) {
            return $month->count();
        });

        return response()->json($countOfUse);
    }
}
