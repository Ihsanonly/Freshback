<?php

return [
    'url' => env('AI_API_URL', 'https://api.ferdev.me/ai/gemini'),
    'key' => env('AI_API_KEY'),
    'timeout' => (int) env('AI_API_TIMEOUT', 45),
];
