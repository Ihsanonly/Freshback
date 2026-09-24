<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0f7a4c">
    <title>AI Recipe - FRESHBACK</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script>(function(){try{var t=localStorage.getItem('theme');if(!t){t=(window.matchMedia&&window.matchMedia('(prefers-color-scheme: dark)').matches)?'dark':'light';}document.documentElement.setAttribute('data-theme',t);}catch(e){}})();</script>
</head>
<body>
    <main class="shell">
        <div class="brand">
            @if (request()->routeIs('dashboard') || request()->is('/'))
                <span class="brand-mark" aria-hidden="true">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
                <span>FRESHBACK</span>
            @else
                <a class="back" href="{{ route('dashboard') }}">Beranda</a>
            @endif
        <button class="theme-toggle" type="button" aria-label="Ganti mode tampilan" title="Ganti mode tampilan"><span aria-hidden="true">&#9789;</span></button>
        </div>

        <div class="topbar">
            <strong>AI Recipe</strong>
        </div>

        <section class="hero">
            <span class="eyebrow">✨ Smart Recipe Assistant</span>
            <h1>Masak dari yang kamu punya.</h1>
            <p>
                Masukkan bahan yang tersedia. FRESHBACK akan meminta AI membuat rekomendasi resep,
                lengkap dengan bahan, langkah memasak, dan kata kunci video tutorial YouTube.
            </p>
        </section>

        <section class="form-card">
            <form method="POST" action="{{ route('recipes.generate') }}">
                @csrf
                <label for="ingredients">Bahan yang tersedia</label>
                <div class="input-row">
                    <textarea
                        id="ingredients"
                        name="ingredients"
                        placeholder="Contoh: 2 telur, mie, kecap, bawang putih"
                        required
                    >{{ old('ingredients', $ingredients) }}</textarea>
                    <button type="submit">✨ Cari Ide Resep</button>
                </div>
                <div class="hint">Tips: tulis bahan sebanyak mungkin supaya rekomendasi AI lebih relevan.</div>
                @error('ingredients')
                    <div class="validation-error">{{ $message }}</div>
                @enderror
            </form>

            @if ($error)
                <div class="error">
                    <strong>AI belum bisa memberikan resep.</strong><br>
                    {{ $error }}
                </div>
            @endif
        </section>

        @if (count($recipes) > 0)
            <div class="results-head">
                <div>
                    <h2>Rekomendasi untukmu</h2>
                    <p>Bahan: {{ $ingredients }}</p>
                </div>
            </div>

            <section class="results">
                @foreach ($recipes as $recipe)
                    @php
                        $difficulty = strtolower((string) ($recipe['difficulty'] ?? 'mudah'));
                        $difficultyClass = match (true) {
                            str_contains($difficulty, 'sulit') => 'hard',
                            str_contains($difficulty, 'sedang') => 'medium',
                            default => 'easy',
                        };
                        $query = (string) ($recipe['youtube_search_query'] ?? '');
                        $youtubeUrl = $query !== ''
                            ? 'https://www.youtube.com/results?search_query=' . rawurlencode($query)
                            : null;
                    @endphp

                    <article class="recipe">
                        <h3>{{ $recipe['name'] ?? 'Resep FRESHBACK' }}</h3>
                        <p class="reason">{{ $recipe['reason'] ?? 'Resep ini direkomendasikan berdasarkan bahan yang tersedia.' }}</p>

                        <div class="meta">
                            <span class="chip time">⏱ {{ $recipe['time_minutes'] ?? '-' }} menit</span>
                            <span class="chip {{ $difficultyClass }}">{{ $recipe['difficulty'] ?? 'Mudah' }}</span>
                        </div>

                        @if (!empty($recipe['ingredients']) && is_array($recipe['ingredients']))
                            <div class="block-title">Bahan</div>
                            <ul>
                                @foreach ($recipe['ingredients'] as $ingredient)
                                    <li>{{ $ingredient }}</li>
                                @endforeach
                            </ul>
                        @endif

                        @if (!empty($recipe['steps']) && is_array($recipe['steps']))
                            <div class="block-title">Langkah</div>
                            <ol>
                                @foreach ($recipe['steps'] as $step)
                                    <li>{{ $step }}</li>
                                @endforeach
                            </ol>
                        @endif

                        @if ($youtubeUrl)
                            <a class="video-link" href="{{ $youtubeUrl }}" target="_blank" rel="noopener noreferrer">
                                ▶ Cari Video Tutorial YouTube
                            </a>
                        @endif
                    </article>
                @endforeach
            </section>
        @else
            <div class="results-head">
                <div>
                    <h2>Rekomendasi Resep</h2>
                    <p>Hasil AI akan muncul di sini setelah kamu memasukkan bahan.</p>
                </div>
            </div>

            <div class="empty-results">
                🍳 Belum ada rekomendasi. Coba masukkan beberapa bahan yang tersedia di rumah.
            </div>
        @endif
    </main>
    <script>
    (function () {
        var root = document.documentElement;

        function paint(btn) {
            var dark = root.getAttribute('data-theme') === 'dark';
            btn.innerHTML = '<span aria-hidden="true">' + (dark ? '\u2600\uFE0F' : '\uD83C\uDF19') + '</span>';
            var label = dark ? 'Aktifkan mode terang' : 'Aktifkan mode gelap';
            btn.setAttribute('aria-label', label);
            btn.setAttribute('title', label);
        }

        document.querySelectorAll('.theme-toggle').forEach(function (btn) {
            paint(btn);
            btn.addEventListener('click', function () {
                var next = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
                root.setAttribute('data-theme', next);
                try { localStorage.setItem('theme', next); } catch (e) {}
                document.querySelectorAll('.theme-toggle').forEach(paint);
            });
        });
    })();
    </script>
</body>
</html>
