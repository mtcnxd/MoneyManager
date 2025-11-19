<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingBook extends Model
{
    use HasFactory;

    public    $currentValue = 0.0;
    protected $ticker = [];
    protected $table = 'shopping_list';

    protected $fillable = [
        'userid',
        'book',
        'amount',
        'price',
        'status',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function setTicker($ticker)
    {
        $this->ticker = $ticker;
    }

    public function getCurrentValue()
    {
        return $this->amount * $this->ticker->last;
    }

    public function getChange()
    {
        $lastValue    = $this->amount * $this->price;
        $currentValue = $this->getCurrentValue();

        return ($currentValue - $lastValue);
    }

    public function getPercentage()
    {        
        return ($this->getChange() / $this->getCurrentValue()) * 100;
    }
}
