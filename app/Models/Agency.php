<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];

    /**
     * Get all of the agencyDetail for the Agency
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function agencyDetail(): HasMany
    {
        return $this->hasMany(AgencyDetail::class);
    }
}
