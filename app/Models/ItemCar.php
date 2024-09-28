<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemCar extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'inventory_id',
        'user_id',
        'status',
        'quantity',
    ];

    /**
     * Get the inventory that owns the ItemCar
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class, 'inventory_id', 'id');
    }
}
