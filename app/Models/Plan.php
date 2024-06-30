<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'amount',
        'stripe_id',
        'duration',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($plan) {
//             $stripe = new \Stripe\StripeClient(env('ST
// RIPE_SECRET'));
//             $stripePlan = $stripe->products->create([
//                 'name' => $plan->name,
//             ]);
//             $stripePlan = $stripe->prices->create([
//                 'unit_amount' => $plan->amount,
//                 'currency' => 'usd',
//                 'recurring' => ['interval' => 'month'],
//                 'product' => $stripePlan->id,
//             ]);
//             $plan->stripe_id = $stripePlan->id;
        });
    }
    
    public function subscriptions(): HasMany
    { 
        return $this->hasMany(Subscription::class);
    }
}
