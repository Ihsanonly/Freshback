<?php

namespace Tests\Feature;

use App\Models\Food;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FoodsPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_foods_page_reads_data_from_database(): void
    {
        Food::create([
            'name' => 'Roti',
            'quantity' => '2',
            'purchase_date' => '2026-09-03',
            'shelf_life_days' => 5,
            'category' => 'Karbohidrat',
            'notes' => 'Untuk sarapan',
        ]);

        Food::create([
            'name' => 'Susu',
            'quantity' => '1',
            'purchase_date' => '2026-09-02',
            'shelf_life_days' => 4,
            'category' => 'Minuman',
            'notes' => 'Untuk minum pagi',
        ]);

        Food::create([
            'name' => 'Telur',
            'quantity' => '6',
            'purchase_date' => '2026-09-05',
            'shelf_life_days' => 7,
            'category' => 'Protein',
            'notes' => 'Untuk sarapan',
        ]);

        Food::create([
            'name' => 'Milo',
            'quantity' => '1',
            'purchase_date' => '2026-09-04',
            'shelf_life_days' => 30,
            'category' => 'Minuman',
            'notes' => 'Untuk minum pagi',
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
        $response->assertSee('Kategori');
        $response->assertSee('Catatan');
        $response->assertSee('Aksi');
        $response->assertSee('📝');
        $response->assertSee('🗑️');
        $response->assertSee('Total data: 4');
        $response->assertSee('Tes koneksi database');
        $response->assertSeeInOrder(['Telur', '05/09/26', 'Milo', '04/09/26', 'Roti', '03/09/26', 'Susu', '02/09/26']);
    }
}
