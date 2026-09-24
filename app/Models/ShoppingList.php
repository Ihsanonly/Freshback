<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{
    protected $table = 'shopping_lists';

    protected $fillable = [
        'item_name',
        'is_bought',
    ];

    protected $casts = [
        'is_bought' => 'boolean',
    ];
}
