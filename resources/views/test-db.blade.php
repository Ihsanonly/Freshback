<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tes Database FRESHBACK</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f6fbf8;
            color: #17231d;
        }

        main {
            max-width: 720px;
            margin: 64px auto;
            padding: 32px;
            background: #ffffff;
            border: 1px solid #dcebe2;
            border-radius: 12px;
            box-shadow: 0 12px 28px rgba(22, 101, 52, 0.08);
        }

        h1 {
            margin-top: 0;
            color: #166534;
        }

        .status {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 999px;
            background: {{ $isSuccess ? '#dcfce7' : '#fee2e2' }};
            color: {{ $isSuccess ? '#166534' : '#991b1b' }};
            font-weight: 700;
        }

        dl {
            display: grid;
            grid-template-columns: 180px 1fr;
            gap: 12px;
            margin-top: 24px;
        }

        dt {
            font-weight: 700;
        }

        dd {
            margin: 0;
        }

        code {
            background: #eef7f0;
            border-radius: 6px;
            padding: 2px 6px;
        }
    </style>
</head>
<body>
    <main>
        <h1>Tes Database FRESHBACK</h1>
        <p class="status">{{ $message }}</p>

        <dl>
            <dt>Database</dt>
            <dd>{{ $databaseName }}</dd>

            <dt>Tabel</dt>
            <dd><code>foods</code></dd>

            <dt>Model</dt>
            <dd><code>{{ $modelName }}</code></dd>

            <dt>Total data foods</dt>
            <dd>{{ $totalFoods }}</dd>
        </dl>
    </main>
</body>
</html>
