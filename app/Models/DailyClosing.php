<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyClosing extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'code',
        'user_id',
        'ref_debito',
        'ref_credito',
        'ref_visaMaster',
        'amount_debito',
        'amount_credito',
        'amount_visaMaster',
        'total_efectivo_usd',
        'total_efectivo_bsd',
        'total_zelle',
        'total_banesco_panama',
        'total_pago_movil',
        'total_transferencia',
        'created_by',
    ];
}
