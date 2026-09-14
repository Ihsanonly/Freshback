<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - FRESHBACK</title>
    <style>
        :root {
            --bg: #f6fbf8;
            --panel: #ffffff;
            --line: #dcebe2;
            --text: #17231d;
            --muted: #647067;
            --green: #166534;
            --green-soft: #dcfce7;
            --blue: #0369a1;
            --blue-soft: #e0f2fe;
            --yellow: #a16207;
            --yellow-soft: #fef3c7;
            --red: #b91c1c;
            --red-soft: #fee2e2;
            --gray: #475569;
            --gray-soft: #f1f5f9;
        }

        * { box-sizing: border-box; }

        html, body {
            margin: 0;
            min-height: 100%;
            background: var(--bg);
            color: var(--text);
            font-family: Arial, sans-serif;
        }

        body { min-height: 100vh; }

        main {
            width: min(1120px, calc(100% - 32px));
            margin: 0 auto;
            padding: 34px 0 48px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--green);
            font-size: 14px;
            font-weight: 800;
            letter-spacing: .3px;
        }

        .brand-mark {
            position: relative;
            width: 22px;
            height: 18px;
            flex: 0 0 22px;
        }

        .brand-mark span {
            position: absolute;
            width: 11px;
            height: 7px;
            border-radius: 2px;
            transform: rotate(25deg);
        }

        .brand-mark span:nth-child(1) { left: 1px; top: 4px; background: #22c55e; }
        .brand-mark span:nth-child(2) { left: 6px; top: 7px; background: #38bdf8; }
        .brand-mark span:nth-child(3) { left: 11px; top: 2px; background: #c084fc; }

        header {
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 24px;
            margin: 26px 0 28px;
        }

        h1 {
            margin: 0 0 8px;
            color: var(--green);
            font-family: Consolas, "Courier New", monospace;
            font-size: clamp(26px, 4vw, 38px);
        }

        .subtitle {
            margin: 0;
            max-width: 670px;
            color: var(--muted);
            line-height: 1.6;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 0 16px;
            border-radius: 9px;
            border: 1px solid #15803d;
            background: var(--green);
            color: #fff;
            font-weight: 800;
            text-decoration: none;
            transition: transform 180ms ease, box-shadow 180ms ease, background 180ms ease;
        }

        .button:hover {
            background: #15803d;
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(22, 101, 52, .16);
            text-decoration: none;
        }

        .button.secondary {
            border-color: #b8d5c2;
            background: #fff;
            color: var(--green);
        }

        .grid {
            display: grid;
            gap: 16px;
        }

        .stats {
            grid-template-columns: repeat(5, minmax(0, 1fr));
            margin-bottom: 22px;
        }

        .card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: 0 10px 24px rgba(22, 101, 52, .05);
        }

        .stat-card {
            padding: 18px;
        }

        .stat-card .label {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.4;
        }

        .stat-card .number {
            margin-top: 8px;
            font-family: Consolas, "Courier New", monospace;
            font-size: 30px;
            font-weight: 800;
        }

        .stat-card.total .number { color: var(--green); }
        .stat-card.high .number { color: var(--red); }
        .stat-card.medium .number { color: var(--yellow); }
        .stat-card.safe .number { color: var(--green); }
        .stat-card.expired .number { color: var(--gray); }

        .content-grid {
            grid-template-columns: minmax(0, 1.35fr) minmax(300px, .65fr);
            align-items: start;
        }

        .section {
            padding: 22px;
        }

        .section-head {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: center;
            margin-bottom: 16px;
        }

        .section h2 {
            margin: 0;
            color: var(--green);
            font-family: Consolas, "Courier New", monospace;
            font-size: 18px;
        }

        .section-link {
            color: var(--green);
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
        }

        .priority-list {
            display: grid;
            gap: 10px;
        }

        .food-row {
            display: grid;
            grid-template-columns: minmax(130px, 1fr) auto;
            gap: 16px;
            padding: 15px 0;
            border-bottom: 1px dashed var(--line);
        }

        .food-row:last-child { border-bottom: 0; padding-bottom: 0; }
        .food-row:first-child { padding-top: 0; }

        .food-name {
            margin-bottom: 6px;
            font-weight: 800;
        }

        .food-meta {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.5;
        }

        .food-note {
            margin-top: 7px;
            color: #46544b;
            font-size: 12px;
            line-height: 1.5;
        }

        .food-side {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 7px;
            min-width: 95px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 28px;
            padding: 0 9px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        .badge.high { background: var(--red-soft); color: var(--red); }
        .badge.medium { background: var(--yellow-soft); color: var(--yellow); }
        .badge.safe { background: var(--green-soft); color: var(--green); }
        .badge.expired { background: var(--gray-soft); color: var(--gray); }

        .days {
            color: var(--muted);
            font-size: 11px;
            font-family: Consolas, "Courier New", monospace;
            text-align: right;
        }

        .empty {
            padding: 20px 0 4px;
            color: var(--muted);
            line-height: 1.6;
        }

        .tip {
            padding: 20px;
            background: linear-gradient(135deg, #f0fdf4, #eff6ff);
            border: 1px solid var(--line);
            border-radius: 12px;
        }

        .tip-icon { font-size: 24px; }

        .tip h3 {
            margin: 9px 0 7px;
            color: var(--green);
            font-size: 18px;
        }

        .tip p {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
        }

        .quick-links {
            display: grid;
            gap: 10px;
            margin-top: 16px;
        }

        .quick-link {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 13px 14px;
            border: 1px solid var(--line);
            border-radius: 10px;
            color: var(--text);
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            background: #fff;
        }

        .quick-link span:last-child { color: var(--green); }

        @media (max-width: 960px) {
            .stats { grid-template-columns: repeat(3, minmax(0, 1fr)); }
            .content-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 700px) {
            main { width: min(100% - 20px, 1120px); padding-top: 20px; }
            header { display: block; }
            .actions { justify-content: flex-start; margin-top: 18px; }
            .stats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .food-row { grid-template-columns: 1fr; }
            .food-side { align-items: flex-start; }
            .days { text-align: left; }
        }

        @media (max-width: 430px) {
            .stats { grid-template-columns: 1fr; }
            .section { padding: 18px; }
        }
    </style>
</head>
<body>
    <main>
        <div class="brand" aria-label="FRESHBACK">
            <span class="brand-mark" aria-hidden="true">
                <span></span>
                <span></span>
                <span></span>
            </span>
            <span>FRESHBACK</span>
        </div>

        <header>
            <div>
                <h1>Dashboard</h1>
                <p class="subtitle">
                    Pantau makanan yang kamu punya, lihat mana yang harus diprioritaskan,
                    dan kurangi risiko makanan terbuang sebelum terlambat.
                </p>
            </div>

            <div class="actions">
                <a class="button" href="{{ route('foods.create') }}">+ Tambah Makanan</a>
                <a class="button secondary" href="{{ route('foods.index') }}">Lihat Semua</a>
            </div>
        </header>

        <section class="grid stats" aria-label="Ringkasan makanan">
            <article class="card stat-card total">
                <div class="label">Total makanan</div>
                <div class="number">{{ $totalFoods }}</div>
            </article>

            <article class="card stat-card high">
                <div class="label">Prioritas tinggi</div>
                <div class="number">{{ $highPriorityCount }}</div>
            </article>

            <article class="card stat-card medium">
                <div class="label">Prioritas sedang</div>
                <div class="number">{{ $mediumPriorityCount }}</div>
            </article>

            <article class="card stat-card safe">
                <div class="label">Masih aman</div>
                <div class="number">{{ $safeCount }}</div>
            </article>

            <article class="card stat-card expired">
                <div class="label">Sudah lewat masa simpan</div>
                <div class="number">{{ $expiredCount }}</div>
            </article>
        </section>

        <section class="grid content-grid">
            <article class="card section">
                <div class="section-head">
                    <h2>🔥 Prioritas untuk digunakan</h2>
                    <a class="section-link" href="{{ route('foods.index') }}">Semua makanan →</a>
                </div>

                @if ($priorityFoods->isEmpty())
                    <div class="empty">
                        Belum ada makanan yang perlu diprioritaskan. Tambahkan data makanan untuk mulai memakai FRESHBACK.
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

            <aside class="card section">
                <div class="tip">
                    <div class="tip-icon">💡</div>
                    <h3>Insight FRESHBACK</h3>
                    <p>
                        FRESHBACK menghitung kondisi makanan dari tanggal dibeli dan masa simpan.
                        Makanan dengan sisa waktu lebih sedikit otomatis naik menjadi prioritas.
                    </p>
                </div>

                <div class="quick-links">
                    <a class="quick-link" href="{{ route('foods.create') }}">
                        <span>Tambah makanan baru</span>
                        <span>＋</span>
                    </a>
                    <a class="quick-link" href="{{ route('foods.index') }}">
                        <span>Kelola daftar makanan</span>
                        <span>→</span>
                    </a>
                </div>
            </aside>
        </section>
    </main>
</body>
</html>
