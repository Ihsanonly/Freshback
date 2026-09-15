<?php

return [
    'url' => env('AI_API_URL'),
    'key' => env('AI_API_KEY'),
    'model' => env('AI_API_MODEL', 'gpt-5.6-luna'),
    'timeout' => (int) env('AI_API_TIMEOUT', 45),
];
