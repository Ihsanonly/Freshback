<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FRESHBACK</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            font-family: Arial, sans-serif;
            background: #f6fbf8;
            color: #17231d;
        }

        main {
            width: min(720px, calc(100% - 32px));
            padding: 32px;
            background: #ffffff;
            border: 1px solid #dcebe2;
            border-radius: 12px;
            box-shadow: 0 12px 28px rgba(22, 101, 52, 0.08);
        }

        h1 {
            margin: 0 0 12px;
            color: #166534;
        }

        p {
            margin: 0 0 12px;
        }

        a {
            color: #166534;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <main>
        <h1>FRESHBACK</h1>
        <p>Project Laravel sudah aktif.</p>
        <p><a href="{{ route('foods.index') }}">Daftar makanan</a></p>
        <p><a href="{{ url('/test-db') }}">Tes koneksi database</a></p>
    </main>
</body>
</html>
