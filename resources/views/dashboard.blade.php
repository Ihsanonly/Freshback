<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0f7a4c">
    <title>Dashboard - FRESHBACK</title>
    <style>
        :root {
            --bg: #f4fbf7;
            --panel: rgba(255, 255, 255, 0.92);
            --panel-solid: #ffffff;
            --line: #dcebe2;
            --text: #17231d;
            --muted: #647067;
            --green-950: #064e2d;
            --green-900: #0a6038;
            --green: #138a57;
            --green-700: #16a363;
            --green-soft: #dcfce7;
            --blue: #1687c4;
            --blue-soft: #e0f2fe;
            --purple: #8b5cf6;
            --purple-soft: #ede9fe;
            --yellow: #c47a08;
            --yellow-soft: #fff3c4;
            --red: #dc3b3b;
            --red-soft: #fee2e2;
            --gray: #526171;
            --gray-soft: #eef2f6;
            --shadow-sm: 0 10px 26px rgba(22, 74, 48, 0.07);
            --shadow-lg: 0 24px 60px rgba(17, 79, 50, 0.13);
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at 8% 8%, rgba(34, 197, 94, .12), transparent 28%),
                radial-gradient(circle at 92% 14%, rgba(56, 189, 248, .12), transparent 24%),
                radial-gradient(circle at 72% 88%, rgba(168, 85, 247, .08), transparent 22%),
                var(--bg);
            overflow-x: hidden;
        }

        body::before,
        body::after {
            content: "";
            position: fixed;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            pointer-events: none;
            filter: blur(8px);
            opacity: .45;
            z-index: -1;
        }

        body::before {
            top: 110px;
            left: -140px;
            background: radial-gradient(circle, rgba(34, 197, 94, .18), transparent 68%);
            animation: driftA 10s ease-in-out infinite;
        }

        body::after {
            right: -150px;
            bottom: 70px;
            background: radial-gradient(circle, rgba(129, 140, 248, .16), transparent 68%);
            animation: driftB 12s ease-in-out infinite;
        }

        a { color: inherit; }

        main {
            width: min(1160px, calc(100% - 32px));
            margin: 0 auto;
            padding: 28px 0 56px;
        }

        .page-enter {
            animation: pageEnter .7s ease both;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--green-900);
            font-size: 14px;
            font-weight: 900;
            letter-spacing: .5px;
            animation: fadeUp .55s .04s ease both;
        }

        .brand-mark {
            position: relative;
            width: 25px;
            height: 21px;
            flex: 0 0 25px;
        }

        .brand-mark span {
            position: absolute;
            width: 13px;
            height: 8px;
            border-radius: 3px;
            transform: rotate(25deg);
            box-shadow: 0 3px 8px rgba(0, 0, 0, .07);
        }

        .brand-mark span:nth-child(1) {
            left: 1px;
            top: 6px;
            background: #22c55e;
        }

        .brand-mark span:nth-child(2) {
            left: 6px;
            top: 9px;
            background: #38bdf8;
        }

        .brand-mark span:nth-child(3) {
            left: 12px;
            top: 2px;
            background: #a78bfa;
        }

        header {
            position: relative;
            display: grid;
            grid-template-columns: minmax(0, 1.5fr) auto;
            gap: 28px;
            align-items: end;
            margin: 22px 0 24px;
            padding: 30px;
            border: 1px solid rgba(255,255,255,.7);
            border-radius: 24px;
            background:
                linear-gradient(135deg, rgba(255,255,255,.96), rgba(242,255,247,.92) 55%, rgba(239,248,255,.92));
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            animation: fadeUp .65s .1s ease both;
        }

        header::before {
            content: "";
            position: absolute;
            width: 250px;
            height: 250px;
            top: -150px;
            right: -80px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(34, 197, 94, .20), transparent 68%);
            animation: floatBubble 7s ease-in-out infinite;
        }

        header::after {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            bottom: -120px;
            left: 25%;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(56, 189, 248, .12), transparent 66%);
        }

        .hero-copy,
        .hero-actions {
            position: relative;
            z-index: 1;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 10px;
            border-radius: 999px;
            background: #e8fff0;
            color: var(--green-900);
            font-size: 11px;
            font-weight: 900;
            letter-spacing: .7px;
            text-transform: uppercase;
            border: 1px solid #c9efd7;
        }

        h1 {
            margin: 15px 0 9px;
            color: var(--green-950);
            font-family: Consolas, "Courier New", monospace;
            font-size: clamp(32px, 5vw, 46px);
            line-height: 1;
            letter-spacing: -1.6px;
        }

        .hero-title-accent {
            background: linear-gradient(90deg, #0f7a4c, #0c9a60, #1997cf);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .subtitle {
            margin: 0;
            max-width: 720px;
            color: var(--muted);
            font-size: 15px;
            line-height: 1.7;
        }

        .hero-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .button {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 46px;
            padding: 0 17px;
            border-radius: 13px;
            border: 1px solid transparent;
            font-weight: 900;
            text-decoration: none;
            transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease, background .22s ease;
            overflow: hidden;
        }

        .button::before {
            content: "";
            position: absolute;
            inset: 0;
            transform: translateX(-120%);
            background: linear-gradient(100deg, transparent, rgba(255,255,255,.28), transparent);
            transition: transform .5s ease;
        }

        .button:hover::before { transform: translateX(120%); }

        .button.primary {
            background: linear-gradient(135deg, #0f7a4c, #19a665);
            color: white;
            box-shadow: 0 14px 26px rgba(19, 138, 87, .22);
        }

        .button.primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 32px rgba(19, 138, 87, .30);
        }

        .button.secondary {
            background: rgba(255,255,255,.8);
            color: var(--green-900);
            border-color: #cfe4d8;
        }

        .button.secondary:hover {
            transform: translateY(-3px);
            border-color: #9bc8ac;
            box-shadow: 0 12px 24px rgba(40, 95, 62, .10);
            background: white;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 18px;
        }

        .card {
            position: relative;
            background: var(--panel);
            border: 1px solid rgba(215, 233, 223, .9);
            border-radius: 18px;
            box-shadow: var(--shadow-sm);
            backdrop-filter: blur(8px);
        }

        .stat-card {
            min-height: 148px;
            padding: 17px;
            overflow: hidden;
            isolation: isolate;
            animation: fadeUp .58s ease both;
            transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
        }

        .stat-card:nth-child(1) { animation-delay: .16s; }
        .stat-card:nth-child(2) { animation-delay: .21s; }
        .stat-card:nth-child(3) { animation-delay: .26s; }
        .stat-card:nth-child(4) { animation-delay: .31s; }
        .stat-card:nth-child(5) { animation-delay: .36s; }

        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 36px rgba(20, 83, 45, .12);
            border-color: #c9e6d6;
        }

        .stat-card::after {
            content: "";
            position: absolute;
            width: 110px;
            height: 110px;
            right: -38px;
            top: -38px;
            border-radius: 50%;
            opacity: .95;
            z-index: -1;
        }

        .stat-card.total::after { background: radial-gradient(circle, rgba(34,197,94,.16), transparent 66%); }
        .stat-card.high::after { background: radial-gradient(circle, rgba(239,68,68,.14), transparent 66%); }
        .stat-card.medium::after { background: radial-gradient(circle, rgba(245,158,11,.16), transparent 66%); }
        .stat-card.safe::after { background: radial-gradient(circle, rgba(56,189,248,.13), transparent 66%); }
        .stat-card.expired::after { background: radial-gradient(circle, rgba(100,116,139,.14), transparent 66%); }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .stat-icon {
            display: inline-grid;
            place-items: center;
            width: 34px;
            height: 34px;
            border-radius: 11px;
            font-size: 17px;
            background: #f2f8f4;
            border: 1px solid #e0ece4;
        }

        .stat-card.total .stat-icon { background: var(--green-soft); }
        .stat-card.high .stat-icon { background: var(--red-soft); }
        .stat-card.medium .stat-icon { background: var(--yellow-soft); }
        .stat-card.safe .stat-icon { background: var(--blue-soft); }
        .stat-card.expired .stat-icon { background: var(--gray-soft); }

        .stat-label {
            color: var(--muted);
            font-size: 12px;
            font-weight: 700;
            line-height: 1.4;
        }

        .number {
            margin-top: 12px;
            font-family: Consolas, "Courier New", monospace;
            font-size: 34px;
            font-weight: 900;
            letter-spacing: -1px;
        }

        .stat-card.total .number { color: var(--green-900); }
        .stat-card.high .number { color: var(--red); }
        .stat-card.medium .number { color: var(--yellow); }
        .stat-card.safe .number { color: var(--blue); }
        .stat-card.expired .number { color: var(--gray); }

        .stat-caption {
            margin-top: 7px;
            color: var(--muted);
            font-size: 10px;
        }

        .content-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.4fr) minmax(320px, .6fr);
            gap: 18px;
            align-items: start;
        }

        .section {
            padding: 22px;
            animation: fadeUp .6s .42s ease both;
        }

        .section.secondary-section { animation-delay: .48s; }

        .section-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
        }

        .section-heading-wrap {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .heading-icon {
            display: inline-grid;
            place-items: center;
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: linear-gradient(135deg, #fff2cf, #ffe4db);
            font-size: 19px;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,.65);
        }

        .section h2 {
            margin: 0;
            color: var(--green-950);
            font-family: Consolas, "Courier New", monospace;
            font-size: 18px;
            letter-spacing: -.3px;
        }

        .section-subtitle {
            margin: 4px 0 0;
            color: var(--muted);
            font-size: 11px;
        }

        .section-link {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            color: var(--green-900);
            font-size: 12px;
            font-weight: 900;
            text-decoration: none;
            transition: transform .2s ease;
        }

        .section-link:hover { transform: translateX(3px); }

        .priority-list {
            display: grid;
            gap: 9px;
        }

        .food-row {
            position: relative;
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 16px;
            padding: 15px;
            border: 1px solid #edf2ee;
            border-radius: 14px;
            background: linear-gradient(180deg, #ffffff, #fbfefc);
            overflow: hidden;
            transition: transform .24s ease, box-shadow .24s ease, border-color .24s ease;
            animation: rowEnter .55s ease both;
        }

        .food-row:nth-child(1) { animation-delay: .50s; }
        .food-row:nth-child(2) { animation-delay: .56s; }
        .food-row:nth-child(3) { animation-delay: .62s; }
        .food-row:nth-child(4) { animation-delay: .68s; }
        .food-row:nth-child(5) { animation-delay: .74s; }

        .food-row::before {
            content: "";
            position: absolute;
            inset: 0 auto 0 0;
            width: 4px;
            background: linear-gradient(180deg, #16a363, #49c98b);
        }

        .food-row:hover {
            transform: translateX(4px);
            border-color: #cfe5d7;
            box-shadow: 0 13px 28px rgba(30, 88, 54, .09);
        }

        .food-name {
            margin-bottom: 6px;
            font-weight: 900;
            font-size: 15px;
        }

        .food-meta {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.5;
        }

        .food-note {
            margin-top: 8px;
            color: #46544b;
            font-size: 11px;
            line-height: 1.55;
        }

        .food-side {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 8px;
            min-width: 105px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 28px;
            padding: 0 10px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 900;
            white-space: nowrap;
            box-shadow: 0 4px 10px rgba(0,0,0,.04);
        }

        .badge.high { background: var(--red-soft); color: var(--red); }
        .badge.medium { background: var(--yellow-soft); color: var(--yellow); }
        .badge.safe { background: var(--green-soft); color: var(--green-900); }
        .badge.expired { background: var(--gray-soft); color: var(--gray); }

        .days {
            color: var(--muted);
            font-size: 10px;
            font-family: Consolas, "Courier New", monospace;
            text-align: right;
        }

        .empty {
            padding: 28px 18px;
            border: 1px dashed #cfe5d7;
            border-radius: 14px;
            background: #f8fcf9;
            color: var(--muted);
            line-height: 1.7;
            text-align: center;
        }

        .empty-icon {
            font-size: 30px;
            margin-bottom: 8px;
            animation: floatSoft 3s ease-in-out infinite;
        }

        .tip {
            position: relative;
            padding: 21px;
            overflow: hidden;
            background:
                linear-gradient(135deg, rgba(232,255,240,.95), rgba(239,248,255,.96) 55%, rgba(246,242,255,.96));
            border: 1px solid #d6e9dc;
            border-radius: 16px;
        }

        .tip::after {
            content: "";
            position: absolute;
            width: 120px;
            height: 120px;
            right: -40px;
            top: -42px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,255,255,.85), transparent 68%);
        }

        .tip-icon {
            position: relative;
            z-index: 1;
            display: inline-grid;
            place-items: center;
            width: 42px;
            height: 42px;
            border-radius: 13px;
            background: rgba(255,255,255,.72);
            box-shadow: 0 10px 20px rgba(25, 98, 62, .08);
            font-size: 23px;
            animation: floatSoft 3.5s ease-in-out infinite;
        }

        .tip h3 {
            position: relative;
            z-index: 1;
            margin: 13px 0 7px;
            color: var(--green-950);
            font-size: 18px;
        }

        .tip p {
            position: relative;
            z-index: 1;
            margin: 0;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.65;
        }

        .mini-title {
            margin: 18px 0 9px;
            color: var(--green-950);
            font-size: 12px;
            font-weight: 900;
        }

        .quick-links {
            display: grid;
            gap: 9px;
        }

        .quick-link {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 13px 14px;
            border: 1px solid #e1ece5;
            border-radius: 12px;
            color: var(--text);
            text-decoration: none;
            font-size: 12px;
            font-weight: 800;
            background: rgba(255,255,255,.82);
            transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
        }

        .quick-link:hover {
            transform: translateY(-3px);
            border-color: #bddbc9;
            box-shadow: 0 12px 22px rgba(36, 86, 56, .09);
        }

        .quick-link span:last-child {
            display: inline-grid;
            place-items: center;
            width: 27px;
            height: 27px;
            border-radius: 9px;
            background: var(--green-soft);
            color: var(--green-900);
        }

        .status-strip {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            margin-top: 13px;
        }

        .status-chip {
            padding: 9px 10px;
            border-radius: 11px;
            font-size: 10px;
            font-weight: 800;
            text-align: center;
            border: 1px solid transparent;
        }

        .status-chip.good { background: #ebfff2; color: var(--green-900); border-color: #d0f0da; }
        .status-chip.warn { background: #fff8df; color: #966200; border-color: #f2e2ae; }
        .status-chip.danger { background: #fff0f0; color: #ad3131; border-color: #f4cccc; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pageEnter {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes rowEnter {
            from { opacity: 0; transform: translateX(-10px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes floatSoft {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        @keyframes floatBubble {
            0%, 100% { transform: translate3d(0, 0, 0); }
            50% { transform: translate3d(-14px, 10px, 0); }
        }

        @keyframes driftA {
            0%, 100% { transform: translate3d(0, 0, 0); }
            50% { transform: translate3d(45px, 15px, 0); }
        }

        @keyframes driftB {
            0%, 100% { transform: translate3d(0, 0, 0); }
            50% { transform: translate3d(-25px, -20px, 0); }
        }

        @media (max-width: 1020px) {
            .stats { grid-template-columns: repeat(3, minmax(0, 1fr)); }
            .content-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 760px) {
            main { width: min(100% - 20px, 1160px); padding-top: 20px; }
            header { grid-template-columns: 1fr; padding: 24px; }
            .hero-actions { justify-content: flex-start; }
            .food-row { grid-template-columns: 1fr; }
            .food-side { align-items: flex-start; }
            .days { text-align: left; }
        }

        @media (max-width: 560px) {
            .stats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .status-strip { grid-template-columns: 1fr; }
            .section { padding: 18px; }
            .section-head { align-items: flex-start; }
            .section-link { margin-top: 4px; }
        }

        @media (max-width: 390px) {
            .stats { grid-template-columns: 1fr; }
            .hero-actions { flex-direction: column; }
            .button { width: 100%; }
        }

        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .01ms !important;
            }
        }
    </style>
</head>
<body>
    <main class="page-enter">
        <div class="brand" aria-label="FRESHBACK">
            <span class="brand-mark" aria-hidden="true">
                <span></span>
                <span></span>
                <span></span>
            </span>
            <span>FRESHBACK</span>
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
                <a class="button secondary" href="{{ route('foods.index') }}">Lihat Semua →</a>
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
                    <a class="section-link" href="{{ route('foods.index') }}">Semua →</a>
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
                </div>
            </aside>
        </section>
    </main>
</body>
</html>
