<?php

namespace App\Services;

use DB;
use Carbon\Carbon;
use App\Models\CardsModel;

class Card
{  
    protected $id;
    protected $name;
    protected $info;

    public function __construct($id)
    {
        $this->info = CardsModel::where('id', $id)->first();

        $this->id = $id;
        $this->name = $this->info->name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCardInfo()
    {
        return $this->info;
    }

    public function getPercentageUsed()
    {
        $currentUsage = DB::table('credit_cards_movs')
            ->where('card_id', $this->id)
            ->sum('amount');

        return number_format(($currentUsage/$this->info->limit) * 100, 2);
    }
}