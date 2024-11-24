<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Roster extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'team',
        'commision_usd',
        'commision_bsd',
        'discount_usd',
        'discount_bsd',
        'bond_usd',
        'bond_bsd',
        'date_execution',
        'date_start',
        'date_end',
        'created_by',
    ];

    /**
     * Get the user that owns the Roster
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
