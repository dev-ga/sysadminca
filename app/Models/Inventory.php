<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'sku',
        'code',
        'product',
        'category',
        'subcategory',
        'size',
        'color',
        'model',
        'material',
        'variation_1',
        'variation_2',
        'variation_3',
        'variation_4',
        'variation_5',
        'date',
        'price',
        'quantity',
        'image',
        'created_by',
    ];

    /**
     * Get all of the inventoryMovements for the Inventory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventoryMovements(): HasMany
    {
        return $this->hasMany(InventoryMovement::class, 'id', 'inventory_id');
    }
}
