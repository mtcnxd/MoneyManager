<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardsModel extends Model
{
    use HasFactory;

    protected $table = 'credit_cards';

    protected $fillable = [
        'name',
        'color',
        'limit',
        'cutoff_day'
    ];
}
