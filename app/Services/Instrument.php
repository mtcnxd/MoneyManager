<?php

namespace App\Services;

use App\Contracts\InstrumentInterface;
use App\Models\InstrumentModel;
use Carbon\Carbon;
use Exception;

class Instrument
{  
    public $investName;
    protected $currentInvest;
    protected $lastInvestDate;
    protected $lastInvestAmount;

    public function __construct($name)
    {
        $values = InstrumentModel::where('instrument_id', $name)->latest()->first();

        $this->id               = $values->id;
        $this->investName       = $values->instrument_id;
        $this->lastInvestDate   = $values->created_at;
        $this->lastInvestAmount = $values->amount;
    }

    public function getName()
    {
        return $this->investName;
    }

    public function getLatestInvest()
    {
        $db = InstrumentModel::where('instrument_id', $this->investName)
            ->orderBy('created_at','desc')
            ->limit(2)
            ->pluck('amount')
            ->toArray();

        if (count($db) < 2){
            return 0;
        }

        return ($db[0] - $db[1]);
    }

    public function getTotalInvest()
    {        
        return $this->lastInvestAmount;
    }

    public function getLastInvestDate()
    {
        return $this->lastInvestDate->format('d/m/Y');
    }    
}