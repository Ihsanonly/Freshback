<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class RecipeTest extends TestCase
{
    use RefreshDatabase;

    private const API_URL = 'https://ai.tamandata.com/v1/chat/completions';

    private function configureAi(array $overrides = []): void
    {
        config($overrides + [
            'ai.url' => self::API_URL,
            'ai.key' => 'test-key',
            'ai.model' => 'tamandata',
            'ai.timeout' => 45,
        ]);
    }

    private function recipesJson(int $count = 1): string
    {
        $recipes = [];

        for ($i = 1; $i <= $count; $i++) {
            $recipes[] = [
                'name' => 'Mie Telur Kecap '.$i,
                'reason' => 'Memakai bahan yang tersedia.',
                'time_minutes' => 10,
                'difficulty' => 'Mudah',
                'ingredients' => ['Mie', '2 telur', 'Kecap'],
                'steps' => ['Rebus mie.', 'Masak telur.', 'Campurkan semua bahan.'],
                'youtube_search_query' => 'cara membuat mie telur kecap',
            ];
        }

        return json_encode(['recipes' => $recipes], JSON_UNESCAPED_UNICODE);
    }

    private function openAiResponse(string $content): array
    {
        return [
            'id' => 'chatcmpl-test',
            'object' => 'chat.completion',
            'choices' => [
                [
                    'index' => 0,
                    'message' => [
                        'role' => 'assistant',
                        'content' => $content,
                    ],
                    'finish_reason' => 'stop',
                ],
            ],
        ];
    }

    public function test_recipe_page_can_be_opened(): void
    {
        $response = $this->get('/recipes');

        $response->assertOk();
        $response->assertSee('AI Recipe');
        $response->assertSee('Masak dari yang kamu punya.');
        $response->assertSee('Cari Ide Resep');
    }

    public function test_successful_generation_uses_openai_compatible_request_and_format(): void
    {
        $this->configureAi();

        Http::fake([
            'https://ai.tamandata.com/*' => Http::response(
                $this->openAiResponse($this->recipesJson()),
                200
            ),
        ]);

        $response = $this->post('/recipes', [
            'ingredients' => '2 telur, mie, kecap',
        ]);

        $response->assertOk();
        $response->assertSee('Mie Telur Kecap 1');
        $response->assertSee('Cari Video Tutorial YouTube');
        $response->assertSee('youtube.com/results?search_query=', false);
        $response->assertDontSee('Layanan AI sedang tidak dapat dihubungi.');

        Http::assertSent(function ($request) {
            $query = parse_url($request->url(), PHP_URL_QUERY);
            parse_str(is_string($query) ? $query : '', $params);
            $body = $request->data();

            return $request->method() === 'POST'
                && $request->url() === self::API_URL
                && !array_key_exists('apikey', $params)
                && !array_key_exists('key', $params)
                && ($body['model'] ?? null) === 'tamandata'
                && is_array($body['messages'] ?? null)
                && ($body['messages'][0]['role'] ?? null) === 'user'
                && str_contains((string) ($body['messages'][0]['content'] ?? ''), '2 telur, mie, kecap');
        });
    }

    public function test_api_key_is_sent_as_bearer_authorization_header(): void
    {
        $this->configureAi();

        Http::fake([
            'https://ai.tamandata.com/*' => Http::response(
                $this->openAiResponse($this->recipesJson()),
                200
            ),
        ]);

        $this->post('/recipes', [
            'ingredients' => 'nasi, telur',
        ])->assertOk();

        Http::assertSent(function ($request) {
            return $request->hasHeader('Authorization', 'Bearer test-key')
                && $request->hasHeader('Content-Type', 'application/json');
        });
    }

    public function test_upstream_error_does_not_leak_response_body(): void
    {
        $this->configureAi();

        Http::fake([
            'https://ai.tamandata.com/*' => Http::response(
                'secret-upstream-body-detail {"error":"internal"}',
                500
            ),
        ]);

        $response = $this->post('/recipes', [
            'ingredients' => '2 telur, mie',
        ]);

        $response->assertOk();
        $response->assertSee('Layanan AI sedang tidak dapat dihubungi. Silakan coba lagi nanti.');
        $response->assertDontSee('secret-upstream-body-detail');
        $response->assertDontSee('{"error":"internal"}');
    }

    public function test_malformed_response_is_handled_safely(): void
    {
        $this->configureAi();

        Http::fake([
            'https://ai.tamandata.com/*' => Http::response(
                $this->openAiResponse('ini-bukan-json-resep'),
                200
            ),
        ]);

        $response = $this->post('/recipes', [
            'ingredients' => '2 telur, mie',
        ]);

        $response->assertOk();
        $response->assertSee('Hasil resep dari layanan AI tidak valid. Silakan coba lagi.');
        $response->assertDontSee('ini-bukan-json-resep');
    }

    public function test_missing_choices_payload_is_handled_safely(): void
    {
        $this->configureAi();

        Http::fake([
            'https://ai.tamandata.com/*' => Http::response(['choices' => []], 200),
        ]);

        $response = $this->post('/recipes', [
            'ingredients' => '2 telur, mie',
        ]);

        $response->assertOk();
        $response->assertSee('Layanan AI tidak menghasilkan resep yang bisa dibaca. Silakan coba lagi.');
    }

    public function test_missing_api_key_is_handled_safely_without_request(): void
    {
        $this->configureAi(['ai.key' => null]);

        Http::fake();

        $response = $this->post('/recipes', [
            'ingredients' => '2 telur, mie',
        ]);

        $response->assertOk();
        $response->assertSee('Kunci akses layanan AI belum diatur. Silakan hubungi pengelola aplikasi.');
        $response->assertDontSee('test-key');

        Http::assertNothingSent();
    }

    public function test_missing_api_url_is_handled_safely_without_request(): void
    {
        $this->configureAi(['ai.url' => null]);

        Http::fake();

        $response = $this->post('/recipes', [
            'ingredients' => '2 telur, mie',
        ]);

        $response->assertOk();
        $response->assertSee('Konfigurasi layanan AI belum lengkap. Silakan hubungi pengelola aplikasi.');

        Http::assertNothingSent();
    }

    public function test_recipe_generation_requires_ingredients(): void
    {
        $response = $this->post('/recipes', [
            'ingredients' => '',
        ]);

        $response->assertSessionHasErrors('ingredients');
    }
}
