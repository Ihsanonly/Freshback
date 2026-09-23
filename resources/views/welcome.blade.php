<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FRESHBACK</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script>(function(){try{var t=localStorage.getItem('theme');if(!t){t=(window.matchMedia&&window.matchMedia('(prefers-color-scheme: dark)').matches)?'dark':'light';}document.documentElement.setAttribute('data-theme',t);}catch(e){}})();</script>
</head>
<body>
    <button class="theme-toggle theme-toggle--fixed" type="button" aria-label="Ganti mode tampilan" title="Ganti mode tampilan"><span aria-hidden="true">&#9789;</span></button>

    <main class="shell shell-sm">
        <h1>FRESHBACK</h1>
        <p>Project Laravel sudah aktif.</p>
        <p><a href="{{ route('foods.index') }}">Daftar makanan</a></p>
        <p><a href="{{ route('recipes.index') }}">Resep AI</a></p>
        <p><a href="{{ url('/test-db') }}">Tes koneksi database</a></p>
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
