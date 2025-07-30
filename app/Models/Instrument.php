<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Instrument extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
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

    public function diff()
    {
        $movs = $this->load('investments');
        $first = $movs->investments->first()->amount;
        $last  = $movs->investments->last()->amount;

        return ($last - $first);
    }
}
