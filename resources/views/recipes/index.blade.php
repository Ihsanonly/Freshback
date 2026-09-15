<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0f7a4c">
    <title>AI Recipe - FRESHBACK</title>
    <style>
        :root {
            --bg: #f4fbf7;
            --panel: rgba(255, 255, 255, .94);
            --text: #17231d;
            --muted: #647067;
            --green-950: #064e2d;
            --green-900: #0a6038;
            --green: #138a57;
            --green-soft: #dcfce7;
            --blue: #1687c4;
            --blue-soft: #e0f2fe;
            --purple-soft: #ede9fe;
            --purple: #6d45cf;
            --yellow-soft: #fff3c4;
            --yellow: #9a6700;
            --red-soft: #fee2e2;
            --red: #b42323;
            --line: #dcebe2;
            --shadow: 0 18px 45px rgba(22, 74, 48, .09);
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at 8% 8%, rgba(34, 197, 94, .12), transparent 26%),
                radial-gradient(circle at 92% 12%, rgba(56, 189, 248, .11), transparent 24%),
                radial-gradient(circle at 74% 90%, rgba(139, 92, 246, .08), transparent 22%),
                var(--bg);
        }

        main {
            width: min(1120px, calc(100% - 28px));
            margin: 0 auto;
            padding: 26px 0 56px;
        }

        a { color: inherit; }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--green-900);
            font-size: 14px;
            font-weight: 900;
            letter-spacing: .5px;
            animation: fadeUp .5s ease both;
        }

        .brand-mark {
            position: relative;
            width: 25px;
            height: 21px;
        }

        .brand-mark span {
            position: absolute;
            width: 13px;
            height: 8px;
            border-radius: 3px;
            transform: rotate(25deg);
        }

        .brand-mark span:nth-child(1) { left: 1px; top: 6px; background: #22c55e; }
        .brand-mark span:nth-child(2) { left: 6px; top: 9px; background: #38bdf8; }
        .brand-mark span:nth-child(3) { left: 12px; top: 2px; background: #a78bfa; }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            margin: 20px 0;
        }

        .back {
            display: inline-flex;
            align-items: center;
            min-height: 40px;
            padding: 0 13px;
            border: 1px solid var(--line);
            border-radius: 11px;
            background: #fff;
            color: var(--green-900);
            font-size: 12px;
            font-weight: 900;
            text-decoration: none;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .back:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(29, 85, 53, .08);
        }

        .hero {
            position: relative;
            overflow: hidden;
            padding: 30px;
            border-radius: 24px;
            border: 1px solid rgba(255,255,255,.75);
            background: linear-gradient(135deg, rgba(255,255,255,.97), #effff5 56%, #eff8ff);
            box-shadow: var(--shadow);
            animation: fadeUp .6s .05s ease both;
        }

        .hero::after {
            content: "";
            position: absolute;
            width: 230px;
            height: 230px;
            right: -90px;
            top: -100px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(34,197,94,.16), transparent 68%);
            animation: floatBubble 7s ease-in-out infinite;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            padding: 7px 10px;
            border-radius: 999px;
            border: 1px solid #c9efd7;
            background: #e8fff0;
            color: var(--green-900);
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .7px;
        }

        h1 {
            margin: 14px 0 8px;
            color: var(--green-950);
            font-family: Consolas, "Courier New", monospace;
            font-size: clamp(28px, 5vw, 44px);
            line-height: 1;
        }

        .hero p {
            position: relative;
            z-index: 1;
            max-width: 740px;
            margin: 0;
            color: var(--muted);
            line-height: 1.7;
        }

        .form-card {
            margin-top: 18px;
            padding: 20px;
            border: 1px solid var(--line);
            border-radius: 18px;
            background: var(--panel);
            box-shadow: var(--shadow);
            animation: fadeUp .6s .12s ease both;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: var(--green-900);
            font-size: 13px;
            font-weight: 900;
        }

        .input-row {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 10px;
        }

        textarea {
            width: 100%;
            min-height: 94px;
            resize: vertical;
            padding: 13px 14px;
            border: 1px solid #bfd8c8;
            border-radius: 13px;
            background: #fbfefc;
            color: var(--text);
            font: 700 14px Arial, sans-serif;
            outline: none;
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        textarea:focus {
            border-color: #39ae72;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, .12);
        }

        button {
            align-self: stretch;
            min-width: 170px;
            border: 0;
            border-radius: 13px;
            background: linear-gradient(135deg, #0f7a4c, #19a665);
            color: #fff;
            font-weight: 900;
            cursor: pointer;
            box-shadow: 0 14px 26px rgba(19,138,87,.20);
            transition: transform .22s ease, box-shadow .22s ease;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 32px rgba(19,138,87,.28);
        }

        .hint {
            margin-top: 8px;
            color: var(--muted);
            font-size: 11px;
        }

        .error {
            margin-top: 14px;
            padding: 13px 14px;
            border: 1px solid #f2c5c5;
            border-radius: 12px;
            background: #fff4f4;
            color: var(--red);
            font-size: 12px;
            line-height: 1.6;
        }

        .validation-error {
            margin-top: 7px;
            color: var(--red);
            font-size: 12px;
            font-weight: 700;
        }

        .results-head {
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 12px;
            margin: 30px 0 14px;
        }

        .results-head h2 {
            margin: 0;
            color: var(--green-950);
            font-family: Consolas, "Courier New", monospace;
            font-size: 20px;
        }

        .results-head p {
            margin: 4px 0 0;
            color: var(--muted);
            font-size: 12px;
        }

        .results {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .recipe {
            position: relative;
            overflow: hidden;
            padding: 20px;
            border: 1px solid var(--line);
            border-radius: 18px;
            background: #fff;
            box-shadow: var(--shadow);
            animation: fadeUp .55s ease both;
        }

        .recipe::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(180deg, #16a363, #44c78d);
        }

        .recipe:nth-child(2) { animation-delay: .06s; }
        .recipe:nth-child(3) { animation-delay: .12s; }
        .recipe:nth-child(4) { animation-delay: .18s; }

        .recipe h3 {
            margin: 0;
            color: var(--green-950);
            font-size: 19px;
        }

        .reason {
            margin: 8px 0 13px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
        }

        .meta {
            display: flex;
            gap: 7px;
            flex-wrap: wrap;
            margin-bottom: 14px;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            min-height: 27px;
            padding: 0 9px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 900;
        }

        .chip.time { background: var(--blue-soft); color: #075985; }
        .chip.easy { background: var(--green-soft); color: var(--green-900); }
        .chip.medium { background: var(--yellow-soft); color: var(--yellow); }
        .chip.hard { background: var(--red-soft); color: var(--red); }

        .block-title {
            margin: 15px 0 7px;
            color: var(--green-900);
            font-size: 12px;
            font-weight: 900;
        }

        ul, ol {
            margin: 0;
            padding-left: 20px;
            color: #46544b;
            font-size: 12px;
            line-height: 1.7;
        }

        .video-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-top: 16px;
            padding: 10px 12px;
            border-radius: 11px;
            border: 1px solid #dcebe2;
            background: linear-gradient(135deg, #fff, #f6fbf8);
            color: var(--green-900);
            font-size: 11px;
            font-weight: 900;
            text-decoration: none;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .video-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 18px rgba(30, 88, 54, .08);
        }

        .empty-results {
            padding: 28px;
            border: 1px dashed #bfd8c8;
            border-radius: 18px;
            background: rgba(255,255,255,.72);
            color: var(--muted);
            text-align: center;
            line-height: 1.7;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes floatBubble {
            0%, 100% { transform: translate3d(0,0,0); }
            50% { transform: translate3d(-12px,12px,0); }
        }

        @media (max-width: 780px) {
            .input-row { grid-template-columns: 1fr; }
            button { min-height: 48px; }
            .results { grid-template-columns: 1fr; }
        }

        @media (max-width: 500px) {
            main { width: min(100% - 18px, 1120px); }
            .hero { padding: 22px; }
            .form-card, .recipe { padding: 17px; }
        }

        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            *, *::before, *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .01ms !important;
            }
        }
    </style>
</head>
<body>
    <main>
        <div class="brand" aria-label="FRESHBACK">
            <span class="brand-mark" aria-hidden="true">
                <span></span><span></span><span></span>
            </span>
            <span>FRESHBACK</span>
        </div>

        <div class="topbar">
            <strong>AI Recipe</strong>
            <a class="back" href="{{ route('dashboard') }}">← Kembali ke Dashboard</a>
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
</body>
</html>
