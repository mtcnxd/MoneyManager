<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardMovs extends Model
{
    use HasFactory;

    protected $table = 'credit_cards_movs';

    protected $fillable = [
        'card_id',
        'concept',
        'amount',
        'active',
        'created_at',
        'updated_at'
    ];

    public function car()
    {
        return $this->belongsTo(Card::class, 'card_id');
    }
}
