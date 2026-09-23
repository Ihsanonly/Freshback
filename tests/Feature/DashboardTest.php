<?php

namespace Tests\Feature;

use App\Models\Food;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_can_be_opened_and_shows_food_summary(): void
    {
        Carbon::setTestNow('2026-09-14');

        try {
            Food::create([
                'name' => 'Susu',
                'quantity' => '1',
                'purchase_date' => '2026-09-12',
                'shelf_life_days' => 4,
                'category' => 'Minuman',
            ]);

            Food::create([
                'name' => 'Milo',
                'quantity' => '1',
                'purchase_date' => '2026-09-04',
                'shelf_life_days' => 30,
                'category' => 'Minuman',
            ]);

            $response = $this->get('/');

            $response->assertOk();
            $response->assertSee('Dashboard FRESHBACK');
            $response->assertSee('Total makanan');
            $response->assertSee('Prioritas tinggi');
            $response->assertSee('Prioritas sedang');
            $response->assertSee('Masih aman');
            $response->assertSee('Sudah lewat masa simpan');
            $response->assertSee('Susu');
            $response->assertSee('Milo');
            $response->assertSee('Prioritas untuk digunakan');
            $response->assertSee('Tambah makanan baru');
            $response->assertSee('Kelola daftar makanan');
            $response->assertSee('Buat resep AI');
            $response->assertSee('Insight FRESHBACK');
        } finally {
            Carbon::setTestNow();
        }
    }
}
