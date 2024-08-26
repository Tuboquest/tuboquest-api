<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRankingRequest;
use App\Http\Resources\RankingResource;
use App\Models\Ranking;

class ScoreboardController extends Controller
{
    public function index()
    {
        $rankings = Ranking::top();

        return response()->json(
            RankingResource::collection($rankings)
        );
    }

    public function store(StoreRankingRequest $request)
    {
        $ranking = Ranking::create($request->all());

        return response()->json(
            new RankingResource($ranking),
            201
        );
    }
}
