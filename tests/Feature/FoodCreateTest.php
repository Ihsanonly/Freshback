<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FoodCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_food_page_can_be_opened(): void
    {
        $response = $this->get('/foods/create');

        $response->assertOk();
        $response->assertSee('Tambah Makanan');
        $response->assertSee('Nama Makanan');
        $response->assertSee('Jumlah');
        $response->assertSee('Tanggal Dibeli');
        $response->assertSee('Masa Simpan');
        $response->assertSee('Kategori');
        $response->assertSee('Catatan');
    }

    public function test_food_can_be_stored(): void
    {
        $response = $this->post('/foods', [
            'name' => 'Yogurt',
            'quantity' => '2',
            'purchase_date' => '2026-09-06',
            'shelf_life_days' => 10,
            'category' => 'Dairy',
            'notes' => 'Untuk camilan',
        ]);

        $response->assertRedirect(route('foods.index'));
        $response->assertSessionHas('success', 'Makanan berhasil ditambahkan.');

        $this->assertDatabaseHas('foods', [
            'name' => 'Yogurt',
            'quantity' => '2',
            'shelf_life_days' => 10,
            'category' => 'Dairy',
            'notes' => 'Untuk camilan',
        ]);

        $this->assertSame(
            '2026-09-06',
            \App\Models\Food::where('name', 'Yogurt')->first()->purchase_date->toDateString()
        );
    }

    public function test_store_food_requires_valid_input(): void
    {
        $response = $this->from('/foods/create')->post('/foods', [
            'name' => '',
            'quantity' => '',
            'purchase_date' => '',
            'shelf_life_days' => '',
            'category' => '',
            'notes' => '',
        ]);

        $response->assertRedirect('/foods/create');
        $response->assertSessionHasErrors([
            'name',
            'quantity',
            'purchase_date',
            'shelf_life_days',
            'category',
        ]);
    }
}
