<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';
    protected $fillable = [
        'name',
        'quantity',
        'purchase_date',
        'shelf_life_days',
        'category',
        'notes',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'shelf_life_days' => 'integer',
    ];
}
