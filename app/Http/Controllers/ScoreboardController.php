<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRankingRequest;
use App\Models\Ranking;

class ScoreboardController extends Controller
{
    public function index()
    {
        $rankings = Ranking::top();

        return response()->json($rankings);
    }

    public function store(StoreRankingRequest $request)
    {
        $ranking = Ranking::create($request->all());

        return response()->json($ranking, 201);
    }
}
