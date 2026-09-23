<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Daftar Makanan - FRESHBACK</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script>(function(){try{var t=localStorage.getItem('theme');if(!t){t=(window.matchMedia&&window.matchMedia('(prefers-color-scheme: dark)').matches)?'dark':'light';}document.documentElement.setAttribute('data-theme',t);}catch(e){}})();</script>
</head>

<body>

    <main class="shell-pad">
        <div class="page page--wide">

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
                    <h1>Daftar Makanan</h1>

                    <p class="muted">
                        Total data: {{ $foods->count() }}
                    </p>
                </div>

                <div class="actions">

                    <a
                        class="button"
                        href="{{ route('foods.create') }}"
                    >
                        + Tambah Makanan
                    </a>

                    <a
                        class="text-link"
                        href="{{ url('/test-db') }}"
                    >
                        Tes koneksi database
                    </a>

                </div>

            </header>

            <hr class="divider">

            @if (session('success'))

                <p class="alert">
                    {{ session('success') }}
                </p>

            @endif

            <section class="panel">

                @if ($foods->isEmpty())

                    <p class="empty">
                        Belum ada data makanan di tabel foods.
                    </p>

                @else

                    <table>

                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jumlah</th>
                                <th>Dibeli</th>
                                <th>Masa Simpan</th>
                                <th>Batas Simpan</th>
                                <th>Status</th>
                                <th>Prioritas</th>
                                <th>Kategori</th>
                                <th>Insight FRESHBACK</th>
                                <th class="sticky-action">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($foods as $food)

                                <tr>

                                    <td>
                                        {{ $food->name }}
                                    </td>

                                    <td>
                                        {{ $food->quantity }}
                                    </td>

                                    <td>
                                        {{ $food->purchase_date?->format('d/m/Y') ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $food->shelf_life_days }} hari
                                    </td>

                                    <td>
                                        {{ $food->expiry_date?->format('d/m/Y') ?? '-' }}
                                    </td>

                                    <td>

                                        <span
                                            class="status-badge {{ $food->status_key }}"
                                        >
                                            {{ $food->status }}
                                        </span>

                                        @if ($food->days_remaining !== null)

                                            <div class="days-remaining">

                                                @if ($food->days_remaining < 0)

                                                    Lewat
                                                    {{ abs($food->days_remaining) }}
                                                    hari

                                                @elseif ($food->days_remaining === 0)

                                                    Batas simpan hari ini

                                                @elseif ($food->days_remaining === 1)

                                                    1 hari lagi

                                                @else

                                                    {{ $food->days_remaining }}
                                                    hari lagi

                                                @endif

                                            </div>

                                        @endif

                                    </td>

                                    <td>

                                        <span
                                            class="priority-badge {{ $food->priority_key }}"
                                        >
                                            {{ $food->priority_label }}
                                        </span>

                                    </td>

                                    <td>
                                        {{ $food->category ?: '-' }}
                                    </td>

                                    <td
                                        class="note-cell"
                                        title="{{ $food->auto_note }}"
                                    >
                                        {{ $food->auto_note }}
                                    </td>

                                    <td class="sticky-action">

                                        <div class="row-actions">

                                            <a
                                                class="action-link"
                                                href="{{ route('foods.edit', $food) }}"
                                                title="Edit"
                                                aria-label="Edit {{ $food->name }}"
                                            >
                                                📝
                                            </a>

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

    <!-- MODAL HAPUS -->

    <div
        class="modal-backdrop"
        data-delete-modal
        hidden
    >

        <div
            class="modal"
            role="dialog"
            aria-modal="true"
            aria-labelledby="delete-title"
        >

            <h2 id="delete-title">
                Hapus makanan?
            </h2>

            <p>
                Data
                <strong data-delete-food-name>-</strong>
                akan dihapus dari database.
                Aksi ini tidak bisa dibatalkan.
            </p>

            <form
                method="POST"
                data-delete-form
            >

                @csrf
                @method('DELETE')

                <div class="modal-actions">

                    <button
                        class="cancel-button"
                        type="button"
                        data-close-delete
                    >
                        Batal
                    </button>

                    <button
                        class="delete-submit"
                        type="submit"
                    >
                        Ya, hapus
                    </button>

                </div>

            </form>

        </div>
    </div>

    <script>
        const modal = document.querySelector('[data-delete-modal]');
        const deleteForm = document.querySelector('[data-delete-form]');
        const deleteFoodName = document.querySelector(
            '[data-delete-food-name]'
        );
        const closeDeleteButton = document.querySelector(
            '[data-close-delete]'
        );

        function openDeleteModal(button) {
            deleteForm.action = button.dataset.deleteAction;
            deleteFoodName.textContent = button.dataset.deleteName;

            modal.hidden = false;

            requestAnimationFrame(() => {
                modal.classList.add('is-open');
            });
        }

        function closeDeleteModal() {
            modal.classList.remove('is-open');

            setTimeout(() => {
                modal.hidden = true;
                deleteForm.removeAttribute('action');
                deleteFoodName.textContent = '-';
            }, 180);
        }

        document
            .querySelectorAll('[data-delete-action]')
            .forEach((button) => {

                button.addEventListener('click', () => {
                    openDeleteModal(button);
                });

            });

        closeDeleteButton.addEventListener(
            'click',
            closeDeleteModal
        );

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