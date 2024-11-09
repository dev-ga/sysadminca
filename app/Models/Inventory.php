<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'category_id',
        'subcategory_id',
        'size',
        'color',
        'model',
        'material',
        'variation_1',
        'variation_2',
        'variation_3',
        'variation_4',
        'variation_5',
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

    /**
     * Get all of the inventoryMovements for the Inventory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function itemCars(): HasMany
    {
        return $this->hasMany(ItemCar::class, 'id', 'inventory_id');
    }

    /**
     * Get the Category that owns the Inventory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the Category that owns the Inventory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

    /**
     * Get the saleDetail that owns the Inventory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function saleDetail(): BelongsTo
    {
        return $this->belongsTo(SaleDetail::class);
    }

}
