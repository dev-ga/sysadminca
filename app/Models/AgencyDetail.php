<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgencyDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_id',
        'state_id',
        'name',
        'code',
        'address',
        'phone',
        'email',
    ];

    /**
     * Get the agency that owns the AgencyDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class);
    }
}
