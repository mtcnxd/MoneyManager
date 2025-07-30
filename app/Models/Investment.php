<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    protected $table = 'investments';

    protected $fillable = [
        'instrument_id',
        'amount',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function instrument()
    {
        return $this->belongsTo(Instrument::class, 'instrument_id');
    }    
}
