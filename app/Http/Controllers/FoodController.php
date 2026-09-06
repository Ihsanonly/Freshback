<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

    public function create(): View
    {
        return view('foods.create', [
            'categories' => [
                'Protein',
                'Karbohidrat',
                'Sayur',
                'Buah',
                'Minuman',
                'Dairy',
                'Lainnya',
            ],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'quantity' => ['required', 'string', 'max:50'],
            'purchase_date' => ['required', 'date'],
            'shelf_life_days' => ['required', 'integer', 'min:1', 'max:3650'],
            'category' => ['required', 'string', 'max:50'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ], [
            'name.required' => 'Nama makanan wajib diisi.',
            'quantity.required' => 'Jumlah wajib diisi.',
            'purchase_date.required' => 'Tanggal dibeli wajib diisi.',
            'purchase_date.date' => 'Tanggal dibeli harus berupa tanggal yang valid.',
            'shelf_life_days.required' => 'Masa simpan wajib diisi.',
            'shelf_life_days.integer' => 'Masa simpan harus berupa angka.',
            'shelf_life_days.min' => 'Masa simpan minimal 1 hari.',
            'category.required' => 'Kategori wajib dipilih.',
        ]);

        Food::create($validated);

        return redirect()
            ->route('foods.index')
            ->with('success', 'Makanan berhasil ditambahkan.');
    }
}
