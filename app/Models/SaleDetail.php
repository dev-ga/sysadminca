<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SaleDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sale_id',
        'sale_code',
        'sku',
        'inventory_id',
        'inventory_code',
        'price',
        'quantity',
        'total_pay_usd',
        'user_id',
        'date',
        'status_id',
        'created_by',
    ];

    /**
     * Get the sale that owns the SaleDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

     /**
     * Get the statusSale associated with the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function statu(): BelongsTo
    {
        return $this->belongsTo(Statu::class, 'status_id', 'id');
    }
}
