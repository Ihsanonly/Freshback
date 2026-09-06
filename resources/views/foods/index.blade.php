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
            width: min(1220px, 100%);
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

        .button.danger {
            border-color: #fecaca;
            background: #fee2e2;
            color: #991b1b;
        }

        .button.danger:hover {
            background: #fecaca;
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
            min-width: 1080px;
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
            width: 160px;
        }

        th:nth-child(2),
        td:nth-child(2) {
            width: 92px;
        }

        th:nth-child(3),
        td:nth-child(3) {
            width: 110px;
        }

        th:nth-child(4),
        td:nth-child(4) {
            width: 130px;
        }

        th:nth-child(5),
        td:nth-child(5) {
            width: 150px;
        }

        th:nth-child(6),
        td:nth-child(6) {
            width: 260px;
        }

        th:nth-child(7),
        td:nth-child(7) {
            width: 126px;
            padding-right: 12px;
        }

        .row-actions {
            display: flex;
            gap: 8px;
            align-items: center;
            min-width: 106px;
        }

        .action-link,
        .action-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 46px;
            min-width: 46px;
            min-height: 38px;
            padding: 0;
            border-radius: 8px;
            font-family: Arial, sans-serif;
            font-size: 18px;
            font-weight: 700;
            transition: transform 180ms ease, box-shadow 180ms ease, background 180ms ease;
        }

        .action-link {
            border: 1px solid #67e8f9;
            background: #cffafe;
            color: #0e7490;
        }

        .action-button {
            border: 1px solid #fecaca;
            background: #fee2e2;
            color: #991b1b;
            cursor: pointer;
        }

        .action-link:hover,
        .action-button:hover {
            text-decoration: none;
            transform: translateY(-1px);
            box-shadow: 0 8px 16px rgba(14, 116, 144, 0.12);
        }

        .action-link:hover {
            background: #a5f3fc;
        }

        .note-cell {
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 260px;
        }

        /* TAMBAHAN: Sticky action column agar selalu tampil di kanan */
        th.sticky-action,
        td.sticky-action {
            position: sticky;
            right: 0;
            z-index: 10;
            box-shadow: -3px 0 6px rgba(22, 101, 52, 0.08);
        }
        th.sticky-action {
            background: #eef7f0;
        }
        td.sticky-action {
            background: #ffffff;
        }

        .empty {
            font-family: Consolas, "Courier New", monospace;
            font-size: 14px;
            line-height: 1.6;
            color: #647067;
        }

        .modal-backdrop {
            position: fixed;
            inset: 0;
            display: grid;
            place-items: center;
            padding: 16px;
            background: rgba(23, 35, 29, 0.38);
            opacity: 0;
            pointer-events: none;
            transition: opacity 180ms ease;
        }

        .modal-backdrop.is-open {
            opacity: 1;
            pointer-events: auto;
        }

        .modal {
            width: min(420px, 100%);
            box-sizing: border-box;
            padding: 24px;
            background: #ffffff;
            border: 1px solid #dcebe2;
            border-radius: 12px;
            box-shadow: 0 20px 46px rgba(23, 35, 29, 0.20);
            transform: translateY(12px) scale(0.98);
            transition: transform 180ms ease;
        }

        .modal-backdrop.is-open .modal {
            transform: translateY(0) scale(1);
        }

        .modal h2 {
            margin: 0 0 8px;
            color: #991b1b;
            font-size: 20px;
        }

        .modal p {
            color: #647067;
            line-height: 1.5;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 22px;
        }

        .modal-actions button {
            min-height: 40px;
            padding: 0 14px;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
        }

        .cancel-button {
            border: 1px solid #b8d5c2;
            background: #f6fbf8;
            color: #166534;
        }

        .delete-submit {
            border: 1px solid #dc2626;
            background: #dc2626;
            color: #ffffff;
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
                min-width: 1080px;
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
                                <th class="sticky-action">Aksi</th>
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
                                    <td class="note-cell" title="{{ $food->notes }}">{{ $food->notes ?: '-' }}</td>
                                    <td class="sticky-action">
                                        <div class="row-actions">
                                            <a
                                                class="action-link"
                                                href="{{ route('foods.edit', $food) }}"
                                                title="Edit"
                                                aria-label="Edit {{ $food->name }}"
                                            >📝</a>
                                            <button
                                                class="action-button"
                                                type="button"
                                                title="Hapus"
                                                aria-label="Hapus {{ $food->name }}"
                                                data-delete-action="{{ route('foods.destroy', $food) }}"
                                                data-delete-name="{{ $food->name }}"
                                            >
                                                🗑️
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </section>
        </div>
    </main>

    <div class="modal-backdrop" data-delete-modal hidden>
        <div class="modal" role="dialog" aria-modal="true" aria-labelledby="delete-title">
            <h2 id="delete-title">Hapus makanan?</h2>
            <p>
                Data <strong data-delete-food-name>-</strong> akan dihapus dari database.
                Aksi ini tidak bisa dibatalkan.
            </p>

            <form method="POST" data-delete-form>
                @csrf
                @method('DELETE')

                <div class="modal-actions">
                    <button class="cancel-button" type="button" data-close-delete>Batal</button>
                    <button class="delete-submit" type="submit">Ya, hapus</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.querySelector('[data-delete-modal]');
        const deleteForm = document.querySelector('[data-delete-form]');
        const deleteFoodName = document.querySelector('[data-delete-food-name]');
        const closeDeleteButton = document.querySelector('[data-close-delete]');

        function openDeleteModal(button) {
            deleteForm.action = button.dataset.deleteAction;
            deleteFoodName.textContent = button.dataset.deleteName;
            modal.hidden = false;
            requestAnimationFrame(() => modal.classList.add('is-open'));
        }

        function closeDeleteModal() {
            modal.classList.remove('is-open');

            setTimeout(() => {
                modal.hidden = true;
                deleteForm.removeAttribute('action');
                deleteFoodName.textContent = '-';
            }, 180);
        }

        document.querySelectorAll('[data-delete-action]').forEach((button) => {
            button.addEventListener('click', () => openDeleteModal(button));
        });

        closeDeleteButton.addEventListener('click', closeDeleteModal);

        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                closeDeleteModal();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && !modal.hidden) {
                closeDeleteModal();
            }
        });
    </script>
</body>
</html> 