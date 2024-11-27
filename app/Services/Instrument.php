<?php

namespace App\Services;

use App\Contracts\InstrumentInterface;
use App\Models\InstrumentModel;
use Carbon\Carbon;

class Instrument
{  
    protected $investName;
    protected $currentInvest;
    protected $lastInvestDate;
    protected $lastInvestAmount;

    public function __construct($name)
    {
        $values = InstrumentModel::where('instrument_id',$name)->latest()->first();

        $this->investName       = $name;
        $this->currentInvest    = $values->amount;
        $this->lastInvestDate   = $values->created_at;
        $this->lastInvestAmount = $values->amount;
    }

    public function getName()
    {
        return $this->investName;
    }

    public function getCurrentInvest()
    {
        return $this->currentInvest;
    }

    public function getTotalInvest()
    {
        $total = InstrumentModel::where('instrument_id', $this->investName)->sum('amount');
        
        return $total;
    }

    public function getLastInvestDate()
    {
        return $this->lastInvestDate->format('d/m/Y');
    }    
}