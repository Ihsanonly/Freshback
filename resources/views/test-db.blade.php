<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tes Database FRESHBACK</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script>(function(){try{var t=localStorage.getItem('theme');if(!t){t=(window.matchMedia&&window.matchMedia('(prefers-color-scheme: dark)').matches)?'dark':'light';}document.documentElement.setAttribute('data-theme',t);}catch(e){}})();</script>
</head>
<body>
    <button class="theme-toggle theme-toggle--fixed" type="button" aria-label="Ganti mode tampilan" title="Ganti mode tampilan"><span aria-hidden="true">&#9789;</span></button>

    <main class="shell shell-sm">
        <h1>Tes Database FRESHBACK</h1>
        <p class="status {{ $isSuccess ? 'status-ok' : 'status-fail' }}">{{ $message }}</p>

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
