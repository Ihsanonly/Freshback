<?php

namespace Tests\Feature;

use App\Models\Food;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FoodsPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_foods_page_reads_data_from_database_and_sorts_by_priority(): void
    {
        Carbon::setTestNow('2026-09-13');

        try {
            Food::create([
                'name' => 'Roti',
                'quantity' => '2',
                'purchase_date' => '2026-09-11',
                'shelf_life_days' => 5,
                'category' => 'Karbohidrat',
            ]);

            Food::create([
                'name' => 'Susu',
                'quantity' => '1',
                'purchase_date' => '2026-09-10',
                'shelf_life_days' => 5,
                'category' => 'Minuman',
            ]);

            Food::create([
                'name' => 'Telur',
                'quantity' => '6',
                'purchase_date' => '2026-09-12',
                'shelf_life_days' => 2,
                'category' => 'Protein',
            ]);

            Food::create([
                'name' => 'Milo',
                'quantity' => '1',
                'purchase_date' => '2026-08-01',
                'shelf_life_days' => 60,
                'category' => 'Minuman',
            ]);

            $response = $this->get('/foods');

            $response->assertOk();
            $response->assertSee('FRESHBACK');
            $response->assertSee('Daftar Makanan');
            $response->assertSee('Beranda');
            $response->assertSee(
                'href="' . route('dashboard') . '"',
                false
            );
            $response->assertSee('Nama');
            $response->assertSee('Jumlah');
            $response->assertSee('Dibeli');
            $response->assertSee('Masa Simpan');
            $response->assertSee('Batas Simpan');
            $response->assertSee('Status');
            $response->assertSee('Prioritas');
            $response->assertSee('Kategori');
            $response->assertSee('Insight FRESHBACK');
            $response->assertSee('Aksi');
            $response->assertSee('Tinggi');
            $response->assertSee('Sedang');
            $response->assertSee('Rendah');
            $response->assertSee('Total data: 4');
            $response->assertSee('placeholder="Cari makanan..."', false);
            $response->assertDontSee('🔍');
            $response->assertDontSee('Tes koneksi database');
            $response->assertSee('📝');
            $response->assertSee('🗑️');

            $response->assertSeeInOrder([
                'Telur',
                'Susu',
                'Roti',
                'Milo',
            ]);
        } finally {
            Carbon::setTestNow();
        }
    }

    public function test_search_filters_foods_by_name_case_insensitive(): void
    {
        Carbon::setTestNow('2026-09-13');

        try {
            Food::create([
                'name' => 'Roti Gandum',
                'quantity' => '1',
                'purchase_date' => '2026-09-11',
                'shelf_life_days' => 5,
                'category' => 'Karbohidrat',
            ]);

            Food::create([
                'name' => 'Susu Coklat',
                'quantity' => '1',
                'purchase_date' => '2026-09-10',
                'shelf_life_days' => 5,
                'category' => 'Minuman',
            ]);

            Food::create([
                'name' => 'Telur Ayam',
                'quantity' => '1',
                'purchase_date' => '2026-09-12',
                'shelf_life_days' => 2,
                'category' => 'Protein',
            ]);

            $response = $this->get('/foods?search=roti');

            $response->assertOk();
            $response->assertSee('Roti Gandum');
            $response->assertDontSee('Susu Coklat');
            $response->assertDontSee('Telur Ayam');
            $response->assertSee('Total data: 1');
            $response->assertSee('value="roti"', false);
        } finally {
            Carbon::setTestNow();
        }
    }

    public function test_search_with_empty_query_shows_all_foods(): void
    {
        Carbon::setTestNow('2026-09-13');

        try {
            Food::create([
                'name' => 'Apel',
                'quantity' => '1',
                'purchase_date' => '2026-09-11',
                'shelf_life_days' => 5,
                'category' => 'Buah',
            ]);

            Food::create([
                'name' => 'Beras',
                'quantity' => '1',
                'purchase_date' => '2026-09-10',
                'shelf_life_days' => 30,
                'category' => 'Karbohidrat',
            ]);

            $response = $this->get('/foods?search=');

            $response->assertOk();
            $response->assertSee('Apel');
            $response->assertSee('Beras');
            $response->assertSee('Total data: 2');
        } finally {
            Carbon::setTestNow();
        }
    }

    public function test_search_with_no_result_shows_total_zero(): void
    {
        Carbon::setTestNow('2026-09-13');

        try {
            Food::create([
                'name' => 'Susu',
                'quantity' => '1',
                'purchase_date' => '2026-09-10',
                'shelf_life_days' => 5,
                'category' => 'Minuman',
            ]);

            $response = $this->get('/foods?search=zagzag');

            $response->assertOk();
            $response->assertDontSee('Total data: 1');
            $response->assertSee('Total data: 0');
            $response->assertSee('Belum ada data makanan di tabel foods.');
        } finally {
            Carbon::setTestNow();
        }
    }
}
