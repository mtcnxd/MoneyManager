<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardMSI extends Model
{
    use HasFactory;

    protected $table = 'credit_cards_msi';

    protected $fillable = [
        'mov_id',
        'price',
        'pay_number',
        'due_date',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
