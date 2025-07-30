<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $table = 'credit_cards';

    protected $fillable = [
        'name',
        'color',
        'limit',
        'cutoff_day',
        'network'
    ];

    public function movs()
    {
        return $this->hasMany(CardMovs::class, 'card_id');
    }

    public function total()
    {
        return number_format($this->movs->where('active', true)->sum('amount'), 2);
    }

    public function usage()
    {
        $usage = $this->movs->where('active', true)->sum('amount');
        $percentage = ($usage / $this->limit) * 100;
        return number_format($percentage, 2);
    }
}
