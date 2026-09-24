<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0f7a4c">
    <title>Daftar Belanja - FRESHBACK</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script>(function(){try{var t=localStorage.getItem('theme');if(!t){t=(window.matchMedia&&window.matchMedia('(prefers-color-scheme: dark)').matches)?'dark':'light';}document.documentElement.setAttribute('data-theme',t);}catch(e){}})();</script>
</head>
<body>
    <main class="shell page-enter">
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

        <header>
            <div class="hero-copy">
                <span class="eyebrow">🛒 Smart shopping list</span>
                <h1><span class="hero-title-accent">Daftar Belanja</span></h1>
                <p class="subtitle">
                    Catat barang yang perlu dibeli, centang saat sudah dibeli,
                    dan masukkan makanan yang sudah lewat masa simpan
                    langsung dari halaman daftar makanan.
                </p>
            </div>

            <div class="hero-actions">
                <a class="button secondary" href="{{ route('foods.index') }}">Daftar Makanan</a>
                <a class="button primary" href="{{ route('foods.create') }}">＋ Tambah Makanan</a>
            </div>
        </header>

        @if (session('success'))
            <p class="alert">
                {{ session('success') }}
            </p>
        @endif

        <section class="card section">

            <form
                class="input-row shop-form"
                method="POST"
                action="{{ route('shopping.store') }}"
            >
                @csrf

                <input
                    type="text"
                    name="item_name"
                    maxlength="100"
                    value="{{ old('item_name') }}"
                    placeholder="Nama barang, mis. Beras 5 kg"
                    aria-label="Nama barang"
                    required
                >

                <button type="submit">
                    ＋ Tambah Barang
                </button>
            </form>

            @error('item_name')
                <p class="validation-error">
                    {{ $message }}
                </p>
            @enderror

            @if ($totalCount === 0)

                <div class="empty shop-empty-block">
                    <div class="empty-icon">🛒</div>
                    Belum ada barang di daftar belanja.<br>
                    Tambahkan barang di atas, atau masukkan makanan kedaluwarsa
                    dari halaman daftar makanan.
                </div>

            @else

                <div class="mini-title">
                    Belum dibeli
                    <span class="badge safe">{{ $pendingItems->count() }}</span>
                </div>

                @if ($pendingItems->isEmpty())

                    <p class="shop-empty">
                        Semua barang sudah dibeli. Kerja bagus! 🎉
                    </p>

                @else

                    <ul class="shop-list">

                        @foreach ($pendingItems as $item)

                            <li class="shop-item">

                                <form
                                    method="POST"
                                    action="{{ route('shopping.toggle', $item) }}"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <button
                                        class="shop-check"
                                        type="submit"
                                        title="Tandai sudah dibeli"
                                        aria-label="Tandai {{ $item->item_name }} sudah dibeli"
                                    ></button>
                                </form>

                                <span class="shop-name">
                                    {{ $item->item_name }}
                                </span>

                                <form
                                    method="POST"
                                    action="{{ route('shopping.destroy', $item) }}"
                                    onclick="return confirm('Hapus barang ini dari daftar belanja?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="shop-remove"
                                        type="submit"
                                        title="Hapus"
                                        aria-label="Hapus {{ $item->item_name }}"
                                    >
                                        🗑️
                                    </button>
                                </form>

                            </li>

                        @endforeach

                    </ul>

                @endif

                <div class="mini-title">
                    Sudah dibeli
                    <span class="badge">{{ $boughtItems->count() }}</span>
                </div>

                @if ($boughtItems->isEmpty())

                    <p class="shop-empty">
                        Belum ada barang yang ditandai sudah dibeli.
                    </p>

                @else

                    <ul class="shop-list">

                        @foreach ($boughtItems as $item)

                            <li class="shop-item is-bought">

                                <form
                                    method="POST"
                                    action="{{ route('shopping.toggle', $item) }}"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <button
                                        class="shop-check"
                                        type="submit"
                                        title="Kembalikan ke belum dibeli"
                                        aria-label="Kembalikan {{ $item->item_name }} ke belum dibeli"
                                    >✓</button>
                                </form>

                                <span class="shop-name">
                                    {{ $item->item_name }}
                                </span>

                                <form
                                    method="POST"
                                    action="{{ route('shopping.destroy', $item) }}"
                                    onclick="return confirm('Hapus barang ini dari daftar belanja?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="shop-remove"
                                        type="submit"
                                        title="Hapus"
                                        aria-label="Hapus {{ $item->item_name }}"
                                    >
                                        🗑️
                                    </button>
                                </form>

                            </li>

                        @endforeach

                    </ul>

                @endif

            @endif

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
