<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreBilling extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'inventory_id',
        'code',
        'quantity',
        'price',
        'total_usd',
        'total_bsd',
    ];
}
