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
            ->get()
            ->sort(function (Food $a, Food $b) {
                /*
                 * Priority:
                 * 1 = paling penting
                 * 2 = sedang
                 * 3 = rendah
                 * 0 = expired
                 *
                 * Expired sengaja diletakkan paling bawah.
                 */
                $priorityA = $a->priority;
                $priorityB = $b->priority;

                $sortA = $priorityA === 0 ? 99 : $priorityA;
                $sortB = $priorityB === 0 ? 99 : $priorityB;

                if ($sortA !== $sortB) {
                    return $sortA <=> $sortB;
                }

                /*
                 * Kalau priority sama,
                 * makanan dengan sisa hari lebih sedikit
                 * ditampilkan lebih dahulu.
                 */
                $daysA = $a->days_remaining ?? PHP_INT_MAX;
                $daysB = $b->days_remaining ?? PHP_INT_MAX;

                if ($daysA !== $daysB) {
                    return $daysA <=> $daysB;
                }

                /*
                 * Kalau semuanya sama,
                 * urut berdasarkan nama.
                 */
                return strcasecmp($a->name, $b->name);
            })
            ->values();

        return view('foods.index', [
            'foods' => $foods,
        ]);
    }

    public function create(): View
    {
        return view('foods.create', [
            'categories' => $this->categories(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Food::create($this->validatedFoodData($request));

        return redirect()
            ->route('foods.index')
            ->with('success', 'Makanan berhasil ditambahkan.');
    }

    public function edit(Food $food): View
    {
        return view('foods.edit', [
            'food' => $food,
            'categories' => $this->categories(),
        ]);
    }

    public function update(Request $request, Food $food): RedirectResponse
    {
        $food->update($this->validatedFoodData($request));

        return redirect()
            ->route('foods.index')
            ->with('success', 'Makanan berhasil diperbarui.');
    }

    public function destroy(Food $food): RedirectResponse
    {
        $food->delete();

        return redirect()
            ->route('foods.index')
            ->with('success', 'Makanan berhasil dihapus.');
    }

    private function validatedFoodData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'quantity' => ['required', 'string', 'max:50'],
            'purchase_date' => ['required', 'date'],
            'shelf_life_days' => ['required', 'integer', 'min:1', 'max:3650'],
            'category' => ['required', 'string', 'max:50'],
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
    }

    private function categories(): array
    {
        return [
            'Protein',
            'Karbohidrat',
            'Sayur',
            'Buah',
            'Minuman',
            'Dairy',
            'Lainnya',
        ];
    }
}