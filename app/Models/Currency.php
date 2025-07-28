<?php

namespace App\Models;

class Currency 
{
    protected $tickerInfo;

    public function __construct($tickerInfo = 0)
    {
        $this->tickerInfo = $tickerInfo;
    }

    public function getPrice()
    {
        return $this->tickerInfo->last;
    }

    public function getBook()
    {
        return $this->tickerInfo->book;
    }

    public function getChange()
    {
        return $this->tickerInfo->change_24;
    }

    public function getHigh()
    {
        return $this->tickerInfo->high;
    }

    public function getLow()
    {
        return $this->tickerInfo->low;
    }
}
