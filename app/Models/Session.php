<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Session extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'disk_id',
        'started_at',
        'ended_at',
        'address_id',
        'is_current',
    ];

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }
    public function disk(): BelongsTo
    {
        return $this->belongsTo(Disk::class);
    }
}
