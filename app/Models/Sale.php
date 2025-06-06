<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sale extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sale_code',
        'total_sale',
        'payment_method',
        'tasa_bcv',
        'pay_bsd',
        'pay_usd',
        'date',
        'type_sale',
        'user_id',
        'user_name',
        'commission_bsd',
        'commission_usd',
        'status',
        'proof_payment_id',
        'created_by',
    ];

    /**
     * Get all of the saleDetails for the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function saleDetails(): HasMany
    {
        return $this->hasMany(SaleDetail::class);
    }

    /**
     * Get the statusSale associated with the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Statu::class, 'status_id', 'id');
    }

    /**
     * Get the statusSale associated with the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function proofPayment(): BelongsTo
    {
        return $this->belongsTo(ProofPayment::class, 'proof_payment_id', 'id');
    }

    /**
     * Get the statusSale associated with the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class, 'agency_id', 'id');
    }

    /**
     * Get the statusSale associated with the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sucursal(): BelongsTo
    {
        return $this->belongsTo(AgencyDetail::class, 'sucursal_id', 'id');
    }

    /**
     * Get the statusSale associated with the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function employee(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'sold_by');
    }
}