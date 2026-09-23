<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0f7a4c">
    <title>Dashboard - FRESHBACK</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script>(function(){try{var t=localStorage.getItem('theme');if(!t){t=(window.matchMedia&&window.matchMedia('(prefers-color-scheme: dark)').matches)?'dark':'light';}document.documentElement.setAttribute('data-theme',t);}catch(e){}})();</script>
</head>
<body>
    <main class="shell page-enter">
        <div class="brand" aria-label="FRESHBACK">
            <span class="brand-mark" aria-hidden="true">
                <span></span>
                <span></span>
                <span></span>
            </span>
            <span>FRESHBACK</span>
        <button class="theme-toggle" type="button" aria-label="Ganti mode tampilan" title="Ganti mode tampilan"><span aria-hidden="true">&#9789;</span></button>
        </div>

        <header>
            <div class="hero-copy">
                <span class="eyebrow">✨ Smart food tracker</span>
                <h1><span class="hero-title-accent">Dashboard FRESHBACK</span></h1>
                <p class="subtitle">
                    Pantau makanan yang kamu punya, lihat mana yang harus diprioritaskan,
                    dan kurangi risiko makanan terbuang sebelum terlambat.
                </p>
            </div>

            <div class="hero-actions">
                <a class="button primary" href="{{ route('foods.create') }}">＋ Tambah Makanan</a>
                <a class="button secondary" href="{{ route('recipes.index') }}">✨ Resep AI</a>
            </div>
        </header>

        <section class="stats" aria-label="Ringkasan makanan">
            <article class="card stat-card total">
                <div class="stat-top">
                    <div class="stat-label">Total makanan</div>
                    <div class="stat-icon">🍱</div>
                </div>
                <div class="number">{{ $totalFoods }}</div>
                <div class="stat-caption">Semua data yang tersimpan</div>
            </article>

            <article class="card stat-card high">
                <div class="stat-top">
                    <div class="stat-label">Prioritas tinggi</div>
                    <div class="stat-icon">🔥</div>
                </div>
                <div class="number">{{ $highPriorityCount }}</div>
                <div class="stat-caption">Sebaiknya segera digunakan</div>
            </article>

            <article class="card stat-card medium">
                <div class="stat-top">
                    <div class="stat-label">Prioritas sedang</div>
                    <div class="stat-icon">⚠️</div>
                </div>
                <div class="number">{{ $mediumPriorityCount }}</div>
                <div class="stat-caption">Mulai dipantau</div>
            </article>

            <article class="card stat-card safe">
                <div class="stat-top">
                    <div class="stat-label">Masih aman</div>
                    <div class="stat-icon">✅</div>
                </div>
                <div class="number">{{ $safeCount }}</div>
                <div class="stat-caption">Belum menjadi prioritas</div>
            </article>

            <article class="card stat-card expired">
                <div class="stat-top">
                    <div class="stat-label">Sudah lewat masa simpan</div>
                    <div class="stat-icon">⏳</div>
                </div>
                <div class="number">{{ $expiredCount }}</div>
                <div class="stat-caption">Periksa kondisi terlebih dahulu</div>
            </article>
        </section>

        <section class="content-grid">
            <article class="card section">
                <div class="section-head">
                    <div class="section-heading-wrap">
                        <div class="heading-icon">🔥</div>
                        <div>
                            <h2>Prioritas untuk digunakan</h2>
                            <p class="section-subtitle">Makanan yang paling dekat dengan batas masa simpan</p>
                        </div>
                    </div>
                </div>

                @if ($priorityFoods->isEmpty())
                    <div class="empty">
                        <div class="empty-icon">🥗</div>
                        Belum ada makanan yang perlu diprioritaskan.<br>
                        Tambahkan data makanan untuk mulai memakai FRESHBACK.
                    </div>
                @else
                    <div class="priority-list">
                        @foreach ($priorityFoods as $food)
                            <div class="food-row">
                                <div>
                                    <div class="food-name">{{ $food->name }}</div>
                                    <div class="food-meta">
                                        {{ $food->quantity }} · {{ $food->category }} · Batas {{ $food->expiry_date?->format('d/m/Y') ?? '-' }}
                                    </div>
                                    <div class="food-note">{{ $food->auto_note }}</div>
                                </div>

                                <div class="food-side">
                                    <span class="badge {{ $food->priority_key }}">
                                        {{ $food->priority_label }}
                                    </span>

                                    <div class="days">
                                        @if ($food->days_remaining < 0)
                                            Lewat {{ abs($food->days_remaining) }} hari
                                        @elseif ($food->days_remaining === 0)
                                            Hari ini
                                        @else
                                            {{ $food->days_remaining }} hari lagi
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </article>

            <aside class="card section secondary-section">
                <div class="tip">
                    <div class="tip-icon">💡</div>
                    <h3>Insight FRESHBACK</h3>
                    <p>
                        FRESHBACK menghitung kondisi makanan dari tanggal dibeli dan masa simpan.
                        Makanan dengan sisa waktu lebih sedikit otomatis naik menjadi prioritas.
                    </p>
                </div>

                <div class="mini-title">Status singkat</div>
                <div class="status-strip">
                    <div class="status-chip good">✅ Aman</div>
                    <div class="status-chip warn">⚠ Dipantau</div>
                    <div class="status-chip danger">🔥 Prioritas</div>
                </div>

                <div class="mini-title">Aksi cepat</div>
                <div class="quick-links">
                    <a class="quick-link" href="{{ route('foods.create') }}">
                        <span>Tambah makanan baru</span>
                        <span>＋</span>
                    </a>
                    <a class="quick-link" href="{{ route('foods.index') }}">
                        <span>Kelola daftar makanan</span>
                        <span>→</span>
                    </a>
                    <a class="quick-link" href="{{ route('recipes.index') }}">
                        <span>Buat resep AI</span>
                        <span>✨</span>
                    </a>
                </div>
            </aside>
        </section>
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
