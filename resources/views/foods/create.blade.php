<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tambah Makanan - FRESHBACK</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script>(function(){try{var t=localStorage.getItem('theme');if(!t){t=(window.matchMedia&&window.matchMedia('(prefers-color-scheme: dark)').matches)?'dark':'light';}document.documentElement.setAttribute('data-theme',t);}catch(e){}})();</script>
</head>

<body>
    <main class="shell-pad">
        <div class="page">

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
                <div>
                    <h1>Tambah Makanan</h1>

                    <p class="muted">
                        Masukkan data dasar makanan. Insight dibuat otomatis oleh FRESHBACK.
                    </p>
                </div>

                <a href="{{ route('foods.index') }}">
                    Kembali ke daftar
                </a>
            </header>

            <hr class="divider">

            <div class="form-shell">

                <form
                    method="POST"
                    action="{{ route('foods.store') }}"
                >
                    @csrf

                    <div class="field form-row">
                        <label for="name">
                            Nama Makanan
                        </label>

                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            autocomplete="off"
                            autofocus
                        >

                        @error('name')
                            <p class="error">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="field form-row">
                        <label for="quantity">
                            Jumlah
                        </label>

                        <input
                            id="quantity"
                            name="quantity"
                            type="text"
                            value="{{ old('quantity') }}"
                            autocomplete="off"
                        >

                        @error('quantity')
                            <p class="error">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="field form-row">
                        <label for="purchase_date">
                            Tanggal Dibeli
                        </label>

                        <input
                            id="purchase_date"
                            name="purchase_date"
                            type="date"
                            value="{{ old('purchase_date') }}"
                        >

                        @error('purchase_date')
                            <p class="error">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="field form-row">
                        <label for="shelf_life_days">
                            Masa Simpan
                        </label>

                        <input
                            id="shelf_life_days"
                            name="shelf_life_days"
                            type="number"
                            min="1"
                            value="{{ old('shelf_life_days') }}"
                        >

                        @error('shelf_life_days')
                            <p class="error">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="field form-row">
                        <label for="category">
                            Kategori
                        </label>

                        <select
                            id="category"
                            name="category"
                        >
                            <option value="">
                                Pilih
                            </option>

                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category }}"
                                    @selected(old('category') === $category)
                                >
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>

                        @error('category')
                            <p class="error">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="button-row form-row">

                        <button type="submit">
                            + Simpan
                        </button>

                        <a
                            class="button-link"
                            href="{{ route('foods.index') }}"
                        >
                            Batal
                        </a>

                    </div>
                </form>

                <aside>

                    <div class="auto-note">
                        <h2>
                            ✨ Insight Otomatis
                        </h2>

                        <p>
                            Kamu tidak perlu menulis catatan.
                            Setelah makanan disimpan, FRESHBACK akan menghitung
                            masa simpan dan membuat insight secara otomatis.
                        </p>
                    </div>

                    <div class="preview">

                        <div class="preview-item">
                            <span>Nama</span>

                            <span
                                class="preview-value"
                                data-preview="name"
                            >
                                -
                            </span>
                        </div>

                        <div class="preview-item">
                            <span>Jumlah</span>

                            <span
                                class="preview-value"
                                data-preview="quantity"
                            >
                                -
                            </span>
                        </div>

                        <div class="preview-item">
                            <span>Dibeli</span>

                            <span
                                class="preview-value"
                                data-preview="purchase_date"
                            >
                                -
                            </span>
                        </div>

                        <div class="preview-item">
                            <span>Kategori</span>

                            <span
                                class="preview-value"
                                data-preview="category"
                            >
                                -
                            </span>
                        </div>

                    </div>

                </aside>

            </div>
        </div>
    </main>

    <script>
        const body = document.body;

        const fields = {
            name: document.querySelector('#name'),
            quantity: document.querySelector('#quantity'),
            purchase_date: document.querySelector('#purchase_date'),
            category: document.querySelector('#category'),
        };

        window.addEventListener('load', () => {
            body.classList.add('is-ready');
        });

        function updatePreview() {
            Object.entries(fields).forEach(([key, field]) => {
                const target = document.querySelector(
                    `[data-preview="${key}"]`
                );

                const value = field.value.trim();

                target.textContent = value || '-';
            });
        }

        Object.values(fields).forEach((field) => {
            field.addEventListener('input', updatePreview);
            field.addEventListener('change', updatePreview);
        });

        updatePreview();
    </script>
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