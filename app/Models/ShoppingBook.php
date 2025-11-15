<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingBook extends Model
{
    use HasFactory;

    public    $currentValue = 0.0;
    protected $additionals = [];
    protected $table = 'shopping_book';

    protected $fillable = [
        'userid',
        'book',
        'amount',
        'price',
        'status',
    ];

    public function setAdditionals($additionals)
    {
        $this->additionals = $additionals;
    }

    public function getCurrentValue()
    {
        return $this->amount * $this->additionals->last;
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
