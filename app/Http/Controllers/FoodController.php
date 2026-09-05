<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\View\View;

class FoodController extends Controller
{
    public function index(): View
    {
        $foods = Food::query()
            ->orderByDesc('purchase_date')
            ->orderBy('name')
            ->get();

        return view('foods.index', [
            'foods' => $foods,
        ]);
    }
}
