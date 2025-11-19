<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteBooks extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'favorite',
        'is_active'
    ];

}
