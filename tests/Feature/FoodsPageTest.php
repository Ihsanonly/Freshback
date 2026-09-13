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
            $response->assertSee('+ Tambah Makanan');
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
            $response->assertSee('Tes koneksi database');
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
}
