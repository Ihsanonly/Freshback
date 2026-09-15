<?php

namespace App\Http\Controllers;

use App\Services\AiRecipeService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RuntimeException;

class RecipeController extends Controller
{
    public function __construct(private AiRecipeService $aiRecipeService)
    {
    }

    public function index(): View
    {
        return view('recipes.index', [
            'ingredients' => '',
            'recipes' => [],
            'error' => null,
        ]);
    }

    public function generate(Request $request): View
    {
        $validated = $request->validate([
            'ingredients' => ['required', 'string', 'min:2', 'max:500'],
        ], [
            'ingredients.required' => 'Bahan makanan wajib diisi.',
            'ingredients.min' => 'Masukkan minimal 2 karakter bahan makanan.',
            'ingredients.max' => 'Daftar bahan terlalu panjang. Maksimal 500 karakter.',
        ]);

        try {
            $result = $this->aiRecipeService->generate($validated['ingredients']);

            return view('recipes.index', [
                'ingredients' => $validated['ingredients'],
                'recipes' => $result['recipes'],
                'error' => null,
            ]);
        } catch (RuntimeException $exception) {
            return view('recipes.index', [
                'ingredients' => $validated['ingredients'],
                'recipes' => [],
                'error' => $exception->getMessage(),
            ]);
        }
    }
}
