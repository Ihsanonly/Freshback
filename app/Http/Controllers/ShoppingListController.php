<?php

namespace App\Http\Controllers;

use App\Models\ShoppingList;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShoppingListController extends Controller
{
    public function index(): View
    {
        $items = ShoppingList::query()
            ->orderBy('is_bought')
            ->orderByDesc('created_at')
            ->get();

        return view('shopping_list.index', [
            'pendingItems' => $items->where('is_bought', false)->values(),
            'boughtItems' => $items->where('is_bought', true)->values(),
            'totalCount' => $items->count(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'item_name' => ['required', 'string', 'max:100'],
        ], [
            'item_name.required' => 'Nama barang wajib diisi.',
            'item_name.string' => 'Nama barang tidak valid.',
            'item_name.max' => 'Nama barang maksimal 100 karakter.',
        ]);

        ShoppingList::create($validated);

        return redirect()
            ->back(fallback: route('shopping.index'))
            ->with('success', 'Barang berhasil ditambahkan ke daftar belanja.');
    }

    public function toggle(ShoppingList $shopping): RedirectResponse
    {
        $shopping->update([
            'is_bought' => !$shopping->is_bought,
        ]);

        return redirect()
            ->back(fallback: route('shopping.index'))
            ->with('success', 'Status barang berhasil diperbarui.');
    }

    public function destroy(ShoppingList $shopping): RedirectResponse
    {
        $shopping->delete();

        return redirect()
            ->back(fallback: route('shopping.index'))
            ->with('success', 'Barang berhasil dihapus dari daftar belanja.');
    }
}
