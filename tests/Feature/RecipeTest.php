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

    public function test_recipe_generation_reads_json_from_ai_api(): void
    {
        config([
            'ai.url' => 'https://example.test/v1/chat/completions',
            'ai.key' => 'test-key',
            'ai.model' => 'test-model',
        ]);

        Http::fake([
            'https://example.test/*' => Http::response([
                'choices' => [
                    [
                        'message' => [
                            'content' => json_encode([
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
                            ], JSON_UNESCAPED_UNICODE),
                        ],
                    ],
                ],
            ], 200),
        ]);

        $response = $this->post('/recipes', [
            'ingredients' => '2 telur, mie, kecap',
        ]);

        $response->assertOk();
        $response->assertSee('Mie Telur Kecap');
        $response->assertSee('cara membuat mie telur kecap');

        Http::assertSent(function ($request) {
            return $request->url() === 'https://example.test/v1/chat/completions'
                && $request->hasHeader('Authorization', 'Bearer test-key')
                && $request['model'] === 'test-model';
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
