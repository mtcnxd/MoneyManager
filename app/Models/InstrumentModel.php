<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstrumentModel extends Model
{
    use HasFactory;

    protected $table = 'investments';

    protected $fillable = [
        'instrument_id',
        'amount',
    ];  
}
