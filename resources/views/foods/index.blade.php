<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Makanan - FRESHBACK</title>
    <style>
        html,
        body {
            margin: 0;
            min-height: 100%;
            background: #f6fbf8;
        }

        body {
            min-height: 100vh;
            font-family: Arial, sans-serif;
            color: #17231d;
        }

        main {
            min-height: 100vh;
            box-sizing: border-box;
            padding: 40px 16px;
            background: #f6fbf8;
        }

        .page {
            width: min(1040px, 100%);
            box-sizing: border-box;
            margin: 0 auto;
            padding: 32px;
            background: #ffffff;
            border: 1px solid #dcebe2;
            border-radius: 12px;
            box-shadow: 0 12px 28px rgba(22, 101, 52, 0.08);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 34px;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0;
            color: #166534;
        }

        .brand-mark {
            position: relative;
            width: 20px;
            height: 16px;
            flex: 0 0 20px;
        }

        .brand-mark span {
            position: absolute;
            width: 10px;
            height: 6px;
            border-radius: 2px;
            transform: rotate(25deg);
        }

        .brand-mark span:nth-child(1) {
            left: 2px;
            top: 2px;
            background: #22c55e;
        }

        .brand-mark span:nth-child(2) {
            left: 6px;
            top: 5px;
            background: #38bdf8;
        }

        .brand-mark span:nth-child(3) {
            left: 10px;
            top: 1px;
            background: #c084fc;
        }

        header {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: flex-end;
            margin-bottom: 18px;
        }

        h1 {
            margin: 0 0 8px;
            font-family: Consolas, "Courier New", monospace;
            font-size: 18px;
            font-weight: 700;
            color: #166534;
        }

        p {
            margin: 0;
        }

        a {
            color: #166534;
            font-weight: 700;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .muted {
            color: #647067;
            font-family: Consolas, "Courier New", monospace;
            font-size: 14px;
        }

        .divider {
            width: 100%;
            border: 0;
            border-top: 1px dashed #9ccfaf;
            margin: 0 0 14px;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-end;
            gap: 12px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 40px;
            padding: 0 16px;
            border: 1px solid #86c79a;
            border-radius: 8px;
            background: #dcfce7;
            color: #166534;
            box-shadow: 0 8px 18px rgba(22, 101, 52, 0.08);
        }

        .button:hover {
            text-decoration: none;
            background: #bbf7d0;
        }

        .text-link {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
        }

        .alert {
            margin-bottom: 14px;
            padding: 12px 14px;
            border: 1px solid #86c79a;
            border-radius: 8px;
            background: #dcfce7;
            color: #166534;
            font-weight: 700;
        }

        .panel {
            overflow-x: auto;
            border: 1px solid #dcebe2;
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-family: Consolas, "Courier New", monospace;
            font-size: 15px;
            line-height: 1.7;
            color: #17231d;
        }

        th,
        td {
            padding: 10px 18px 10px 12px;
            border-bottom: 1px solid #e7f1eb;
            text-align: left;
            font-weight: 700;
            white-space: nowrap;
        }

        th {
            background: #eef7f0;
            color: #166534;
        }

        tr:last-child td {
            border-bottom: 0;
        }

        th:nth-child(1),
        td:nth-child(1) {
            width: 138px;
        }

        th:nth-child(2),
        td:nth-child(2) {
            width: 80px;
        }

        th:nth-child(3),
        td:nth-child(3) {
            width: 96px;
        }

        th:nth-child(4),
        td:nth-child(4) {
            width: 116px;
        }

        th:nth-child(5),
        td:nth-child(5) {
            width: 128px;
        }

        th:nth-child(6),
        td:nth-child(6) {
            min-width: 180px;
        }

        .empty {
            font-family: Consolas, "Courier New", monospace;
            font-size: 14px;
            line-height: 1.6;
            color: #647067;
        }

        @media (max-width: 640px) {
            header {
                display: block;
            }

            header a {
                display: inline-block;
                margin-top: 12px;
            }

            .actions {
                justify-content: flex-start;
            }

            table {
                min-width: 760px;
            }
        }
    </style>
</head>
<body>
    <main>
        <div class="page">
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
                    <h1>Daftar Makanan</h1>
                    <p class="muted">Total data: {{ $foods->count() }}</p>
                </div>
                <div class="actions">
                    <a class="button" href="{{ route('foods.create') }}">+ Tambah Makanan</a>
                    <a class="text-link" href="{{ url('/test-db') }}">Tes koneksi database</a>
                </div>
            </header>

            <hr class="divider">

            @if (session('success'))
                <p class="alert">{{ session('success') }}</p>
            @endif

            <section class="panel">
                @if ($foods->isEmpty())
                    <p class="empty">Belum ada data makanan di tabel foods.</p>
                @else
                    <table>
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jumlah</th>
                                <th>Dibeli</th>
                                <th>Masa Simpan</th>
                                <th>Kategori</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($foods as $food)
                                <tr>
                                    <td>{{ $food->name }}</td>
                                    <td>{{ $food->quantity }}</td>
                                    <td>{{ $food->purchase_date?->format('d/m/y') }}</td>
                                    <td>{{ $food->shelf_life_days }} hari</td>
                                    <td>{{ $food->category ?: '-' }}</td>
                                    <td>{{ $food->notes ?: '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </section>
        </div>
    </main>
</body>
</html>
