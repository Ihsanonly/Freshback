<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class RecipeTest extends TestCase
{
    use RefreshDatabase;

    public function test_recipe_page_can_be_opened(): void
    {
        $response = $this->get('/recipes');

        $response->assertOk();
        $response->assertSee('AI Recipe');
        $response->assertSee('Masak dari yang kamu punya.');
        $response->assertSee('Cari Ide Resep');
    }

    public function test_recipe_generation_reads_ferdev_message_json(): void
    {
        config([
            'ai.url' => 'https://api.ferdev.me/ai/gemini',
            'ai.key' => 'test-key',
            'ai.timeout' => 45,
        ]);

        $aiJson = json_encode([
            'recipes' => [
                [
                    'name' => 'Mie Telur Kecap',
                    'reason' => 'Memakai bahan yang tersedia.',
                    'time_minutes' => 10,
                    'difficulty' => 'Mudah',
                    'ingredients' => ['Mie', '2 telur', 'Kecap'],
                    'steps' => ['Rebus mie.', 'Masak telur.', 'Campurkan semua bahan.'],
                    'youtube_search_query' => 'cara membuat mie telur kecap',
                ],
            ],
        ], JSON_UNESCAPED_UNICODE);

        Http::fake([
            'https://api.ferdev.me/*' => Http::response([
                'success' => true,
                'status' => 200,
                'author' => 'Feri',
                'message' => $aiJson,
            ], 200),
        ]);

        $response = $this->post('/recipes', [
            'ingredients' => '2 telur, mie, kecap',
        ]);

        $response->assertOk();
        $response->assertSee('Mie Telur Kecap');
        $response->assertSee('cara membuat mie telur kecap');

        Http::assertSent(function ($request) {
            $query = parse_url($request->url(), PHP_URL_QUERY);
            parse_str(is_string($query) ? $query : '', $params);

            return $request->method() === 'GET'
                && parse_url($request->url(), PHP_URL_PATH) === '/ai/gemini'
                && ($params['apikey'] ?? null) === 'test-key'
                && isset($params['prompt'])
                && str_contains($params['prompt'], '2 telur, mie, kecap');
        });
    }

    public function test_recipe_generation_requires_ingredients(): void
    {
        $response = $this->post('/recipes', [
            'ingredients' => '',
        ]);

        $response->assertSessionHasErrors('ingredients');
    }
}
