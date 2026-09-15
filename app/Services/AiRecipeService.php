<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class AiRecipeService
{
    public function generate(string $ingredients): array
    {
        $url = config('ai.url');
        $key = config('ai.key');
        $model = config('ai.model');
        $timeout = config('ai.timeout', 45);

        if (!$url) {
            throw new RuntimeException('AI_API_URL belum diatur di file .env.');
        }

        if (!$key) {
            throw new RuntimeException('AI_API_KEY belum diatur di file .env.');
        }

        $systemPrompt = <<<'PROMPT'
Kamu adalah FRESHBACK AI Food Assistant, sebuah asisten makanan yang membantu pengguna memanfaatkan bahan yang tersedia agar makanan tidak terbuang.

TUGAS UTAMA:
Berdasarkan bahan makanan yang diberikan pengguna, buat maksimal 4 rekomendasi resep yang realistis, sederhana, dan mudah dibuat di rumah.

ATURAN:
1. Gunakan bahan yang diberikan pengguna sebagai bahan utama.
2. Maksimal 4 resep.
3. Prioritaskan resep yang sederhana, praktis, dan cocok untuk pemula.
4. Boleh menambahkan bahan dasar umum seperti minyak, garam, gula, air, bawang, lada, dan bumbu dasar lainnya.
5. Jangan menjadikan bahan utama yang tidak tersedia sebagai syarat utama resep.
6. Usahakan menggunakan sebanyak mungkin bahan yang tersedia agar mengurangi food waste.
7. Gunakan Bahasa Indonesia.
8. Jangan memberikan URL YouTube.
9. Jangan mengarang atau menebak video, channel, video ID, atau URL.
10. Untuk setiap resep, buat satu kata kunci pencarian YouTube yang spesifik dan relevan.
11. Query YouTube harus berupa kata kunci pencarian, bukan URL.
12. Jangan memberikan penjelasan di luar JSON.

FORMAT OUTPUT WAJIB JSON VALID TANPA MARKDOWN:
{
  "recipes": [
    {
      "name": "Nama resep",
      "reason": "Alasan resep cocok dengan bahan yang tersedia.",
      "time_minutes": 15,
      "difficulty": "Mudah",
      "ingredients": ["Bahan 1", "Bahan 2"],
      "steps": ["Langkah 1", "Langkah 2"],
      "youtube_search_query": "cara membuat nama resep"
    }
  ]
}
PROMPT;

        $response = Http::timeout($timeout)
            ->acceptJson()
            ->withToken($key)
            ->post($url, [
                'model' => $model,
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => $systemPrompt,
                    ],
                    [
                        'role' => 'user',
                        'content' => $ingredients,
                    ],
                ],
                'temperature' => 0.7,
            ]);

        if ($response->failed()) {
            throw new RuntimeException(
                'AI API gagal (' . $response->status() . '): ' . $response->body()
            );
        }

        $payload = $response->json();
        $content = $this->extractContent($payload);
        $recipes = json_decode($this->cleanJson($content), true);

        if (!is_array($recipes) || !isset($recipes['recipes']) || !is_array($recipes['recipes'])) {
            throw new RuntimeException('AI mengembalikan format data resep yang tidak valid.');
        }

        return [
            'recipes' => array_slice($recipes['recipes'], 0, 4),
        ];
    }

    private function extractContent(array $payload): string
    {
        if (isset($payload['choices'][0]['message']['content'])) {
            return (string) $payload['choices'][0]['message']['content'];
        }

        if (isset($payload['message'])) {
            return is_string($payload['message'])
                ? $payload['message']
                : json_encode($payload['message'], JSON_UNESCAPED_UNICODE);
        }

        if (isset($payload['output_text'])) {
            return (string) $payload['output_text'];
        }

        if (isset($payload['output'][0]['content'][0]['text'])) {
            return (string) $payload['output'][0]['content'][0]['text'];
        }

        throw new RuntimeException('Response AI tidak memiliki konten teks yang bisa dibaca.');
    }

    private function cleanJson(string $content): string
    {
        $content = trim($content);
        $content = preg_replace('/^```(?:json)?\s*/i', '', $content) ?? $content;
        $content = preg_replace('/\s*```$/', '', $content) ?? $content;

        return trim($content);
    }
}
