<?php

return [
    'url' => env('AI_API_URL', 'https://ai.tamandata.com/v1/chat/completions'),
    'key' => env('AI_API_KEY'),
    'model' => env('AI_API_MODEL', 'tamandata'),
    'timeout' => (int) env('AI_API_TIMEOUT', 45),
];
