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
        $timeout = config('ai.timeout', 45);

        if (!$url) {
            throw new RuntimeException('AI_API_URL belum diatur di file .env.');
        }

        if (!$key) {
            throw new RuntimeException('AI_API_KEY belum diatur di file .env.');
        }

        $prompt = $this->buildPrompt($ingredients);

        $response = Http::timeout($timeout)
            ->acceptJson()
            ->get($url, [
                'prompt' => $prompt,
                'apikey' => $key,
            ]);

        if ($response->failed()) {
            throw new RuntimeException(
                'Ferdev API gagal (' . $response->status() . '): ' . $response->body()
            );
        }

        $payload = $response->json();

        if (!is_array($payload) || ($payload['success'] ?? false) !== true) {
            throw new RuntimeException('Ferdev API mengembalikan response yang tidak berhasil.');
        }

        $message = $payload['message'] ?? null;

        if (is_array($message)) {
            $recipesPayload = $message;
        } elseif (is_string($message)) {
            $recipesPayload = json_decode($this->cleanJson($message), true);
        } else {
            $recipesPayload = null;
        }

        if (!is_array($recipesPayload) || !isset($recipesPayload['recipes']) || !is_array($recipesPayload['recipes'])) {
            throw new RuntimeException('Ferdev mengembalikan format data resep yang tidak valid.');
        }

        return [
            'recipes' => array_slice($recipesPayload['recipes'], 0, 4),
        ];
    }

    private function buildPrompt(string $ingredients): string
    {
        $template = <<<'PROMPT'
Kamu adalah FRESHBACK AI Food Assistant, sebuah asisten makanan yang membantu pengguna memanfaatkan bahan yang tersedia agar makanan tidak terbuang.

TUGAS UTAMA:
Berdasarkan bahan makanan yang diberikan pengguna, buat maksimal 4 rekomendasi resep yang realistis, sederhana, dan mudah dibuat di rumah.

BAHAN PENGGUNA:
{{ingredients}}

ATURAN RESEP:
1. Gunakan bahan yang diberikan pengguna sebagai bahan utama.
2. Maksimal 4 resep.
3. Prioritaskan resep yang sederhana, praktis, dan cocok untuk pemula.
4. Boleh menambahkan bahan dasar umum seperti minyak, garam, gula, air, bawang, lada, dan bumbu dasar lainnya.
5. Jangan menjadikan bahan utama yang tidak tersedia sebagai syarat utama resep.
6. Usahakan menggunakan sebanyak mungkin bahan yang tersedia agar mengurangi food waste.
7. Gunakan Bahasa Indonesia.
8. Jangan memberikan resep yang berbahaya atau membutuhkan teknik memasak yang sangat sulit.
9. Jangan memberikan URL YouTube.
10. Jangan mengarang atau menebak video, channel, video ID, atau URL.
11. Untuk setiap resep, buat satu kata kunci pencarian YouTube yang spesifik dan relevan.
12. Query YouTube harus berupa kata kunci pencarian, bukan URL.
13. Jangan memberikan penjelasan di luar format JSON.

DATA YANG HARUS DIHASILKAN UNTUK SETIAP RESEP:
- name
- reason
- time_minutes
- difficulty
- ingredients
- steps
- youtube_search_query

FORMAT OUTPUT:
WAJIB menghasilkan JSON valid.
Jangan menggunakan Markdown.
Jangan menggunakan ```json.
Jangan menambahkan teks sebelum atau sesudah JSON.

{
  "recipes": [
    {
      "name": "Nama resep",
      "reason": "Alasan resep cocok dengan bahan yang tersedia.",
      "time_minutes": 15,
      "difficulty": "Mudah",
      "ingredients": [
        "Bahan 1",
        "Bahan 2",
        "Bahan tambahan"
      ],
      "steps": [
        "Langkah 1",
        "Langkah 2",
        "Langkah 3"
      ],
      "youtube_search_query": "cara membuat nama resep"
    }
  ]
}
PROMPT;

        return str_replace('{{ingredients}}', $ingredients, $template);
    }

    private function cleanJson(string $content): string
    {
        $content = trim($content);
        $content = preg_replace('/^```(?:json)?\s*/i', '', $content) ?? $content;
        $content = preg_replace('/\s*```$/', '', $content) ?? $content;

        return trim($content);
    }
}
