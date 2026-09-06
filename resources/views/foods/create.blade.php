<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Makanan - FRESHBACK</title>
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
            width: min(860px, 100%);
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
            font-size: 20px;
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
            margin: 0 0 22px;
        }

        .form-shell {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 240px;
            gap: 24px;
            align-items: start;
        }

        .form-row {
            opacity: 0;
            transform: translateY(12px);
            transition: opacity 260ms ease, transform 260ms ease;
        }

        body.is-ready .form-row {
            opacity: 1;
            transform: translateY(0);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-family: Consolas, "Courier New", monospace;
            font-size: 14px;
            font-weight: 700;
            color: #166534;
        }

        input,
        select,
        textarea {
            width: 100%;
            box-sizing: border-box;
            min-height: 44px;
            padding: 10px 12px;
            border: 1px solid #b8d5c2;
            border-radius: 8px;
            background: #fbfefc;
            color: #17231d;
            font: 700 15px Consolas, "Courier New", monospace;
            outline: 0;
            transition: border-color 180ms ease, box-shadow 180ms ease, transform 180ms ease;
        }

        textarea {
            min-height: 96px;
            resize: vertical;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #22c55e;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.14);
            transform: translateY(-1px);
        }

        .field {
            margin-bottom: 18px;
        }

        .error {
            margin-top: 7px;
            color: #b91c1c;
            font-size: 13px;
            font-weight: 700;
        }

        .button-row {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 24px;
        }

        button,
        .button-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 0 18px;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
        }

        button {
            border: 1px solid #15803d;
            background: #166534;
            color: #ffffff;
            box-shadow: 0 12px 22px rgba(22, 101, 52, 0.18);
            transition: background 180ms ease, transform 180ms ease, box-shadow 180ms ease;
        }

        button:hover {
            background: #15803d;
            transform: translateY(-2px);
            box-shadow: 0 16px 28px rgba(22, 101, 52, 0.22);
        }

        .button-link {
            border: 1px solid #b8d5c2;
            color: #166534;
            background: #f6fbf8;
        }

        .preview {
            position: sticky;
            top: 20px;
            padding: 18px;
            border: 1px solid #dcebe2;
            border-radius: 12px;
            background: #f6fbf8;
        }

        .preview h2 {
            margin: 0 0 14px;
            font-size: 15px;
            color: #166534;
        }

        .preview-list {
            display: grid;
            gap: 10px;
            font-family: Consolas, "Courier New", monospace;
            font-size: 14px;
        }

        .preview-item {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            border-bottom: 1px dashed #b8d5c2;
            padding-bottom: 8px;
        }

        .preview-item:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .preview-value {
            color: #166534;
            font-weight: 700;
            text-align: right;
        }

        @media (max-width: 760px) {
            main {
                padding: 20px 12px;
            }

            .page {
                padding: 24px 16px;
            }

            header {
                display: block;
            }

            header a {
                display: inline-block;
                margin-top: 12px;
            }

            .form-shell {
                grid-template-columns: 1fr;
            }

            .preview {
                position: static;
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
                    <h1>Tambah Makanan</h1>
                    <p class="muted">Catat bahan makanan baru ke database.</p>
                </div>
                <a href="{{ route('foods.index') }}">Kembali ke daftar</a>
            </header>

            <hr class="divider">

            <div class="form-shell">
                <form method="POST" action="{{ route('foods.store') }}">
                    @csrf

                    <div class="field form-row">
                        <label for="name">Nama Makanan</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="off" autofocus>
                        @error('name')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field form-row">
                        <label for="quantity">Jumlah</label>
                        <input id="quantity" name="quantity" type="text" value="{{ old('quantity') }}" autocomplete="off">
                        @error('quantity')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field form-row">
                        <label for="purchase_date">Tanggal Dibeli</label>
                        <input id="purchase_date" name="purchase_date" type="date" value="{{ old('purchase_date') }}">
                        @error('purchase_date')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field form-row">
                        <label for="shelf_life_days">Masa Simpan</label>
                        <input id="shelf_life_days" name="shelf_life_days" type="number" min="1" value="{{ old('shelf_life_days') }}">
                        @error('shelf_life_days')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field form-row">
                        <label for="category">Kategori</label>
                        <select id="category" name="category">
                            <option value="">Pilih</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category }}" @selected(old('category') === $category)>{{ $category }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field form-row">
                        <label for="notes">Catatan</label>
                        <textarea id="notes" name="notes">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="button-row form-row">
                        <button type="submit">+ Simpan</button>
                        <a class="button-link" href="{{ route('foods.index') }}">Batal</a>
                    </div>
                </form>

                <aside class="preview" aria-label="Preview makanan">
                    <h2>Preview</h2>
                    <div class="preview-list">
                        <div class="preview-item">
                            <span>Nama</span>
                            <span class="preview-value" data-preview="name">-</span>
                        </div>
                        <div class="preview-item">
                            <span>Jumlah</span>
                            <span class="preview-value" data-preview="quantity">-</span>
                        </div>
                        <div class="preview-item">
                            <span>Dibeli</span>
                            <span class="preview-value" data-preview="purchase_date">-</span>
                        </div>
                        <div class="preview-item">
                            <span>Kategori</span>
                            <span class="preview-value" data-preview="category">-</span>
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
                const target = document.querySelector(`[data-preview="${key}"]`);
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
</body>
</html>
