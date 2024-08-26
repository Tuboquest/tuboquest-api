<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'score'
    ];

    public function scopeTop($query, $limit = 10)
    {
        return $query->orderBy('score', 'desc')
            ->limit($limit);
    }
}
