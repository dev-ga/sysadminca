<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProofPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_code',
        'user_id',
        'phone',
        'reference',
        'bank_code',
        'bank_name',
        'amount',
        'image',
        'zelle_email',
        'zelle_name',
        'bp_name',
        'bp_reference',
    ];
}
