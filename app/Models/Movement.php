<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use HasFactory;

    protected $fillable = [
        'disk_id',
        'user_id',
        'angle'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function disk()
    {
        return $this->belongsTo(Disk::class);
    }

    public function scopeByUser($query, $user)
    {
        return $query->where('user_id', $user->id);
    }
}
