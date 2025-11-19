<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Support\Helpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Instrument extends Model
{
    use HasFactory;

    protected $hidden = [
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'type',
    ];

    public function investments()
    {
        return $this->hasMany(Investment::class, 'instrument_id');
    }

    public function diffLastMonth()
    {
        $deposits = $this->load('investments');
        $latestDeposits = $deposits->investments->sortByDesc('id')->take(2);

        $result = 0;
        foreach($latestDeposits as $key => $value){
            if ($result == 0){
                $result = $value->amount;
            }
            
            else {
                return [
                    'value'      => $result - $value->amount,
                    'percentage' => Helpers::calculatePercentage($value->amount, $result)
                ];
            }
        };
    }
}
