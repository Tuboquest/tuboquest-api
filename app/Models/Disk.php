<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Disk extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'serial_number',
        'token',
        'is_paired',
        'user_id',
        'angle',
        'pairing_code',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($disk) {
            $disk->angle = 0;
            $disk->serial_number = Str::random(20);
            $disk->token = bin2hex(random_bytes(32));
            $disk->is_paired = $disk->user_id !== null;
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sessions(): HasMany
    { 
        return $this->hasMany(ParkSession::class);
    }
}

