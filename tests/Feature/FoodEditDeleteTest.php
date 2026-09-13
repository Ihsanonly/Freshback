<?php

namespace Tests\Feature;

use App\Models\Food;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FoodEditDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_edit_food_page_can_be_opened(): void
    {
        $food = Food::create([
            'name' => 'Susu',
            'quantity' => '1',
            'purchase_date' => '2026-09-02',
            'shelf_life_days' => 4,
            'category' => 'Minuman',
        ]);

        $response = $this->get(route('foods.edit', $food));

        $response->assertOk();
        $response->assertSee('Edit Makanan');
        $response->assertSee('Susu');
        $response->assertSee('Simpan Perubahan');
        $response->assertSee('Insight Otomatis');
        $response->assertDontSee('name="notes"');
    }

    public function test_food_can_be_updated_without_manual_notes(): void
    {
        $food = Food::create([
            'name' => 'Susu',
            'quantity' => '1',
            'purchase_date' => '2026-09-02',
            'shelf_life_days' => 4,
            'category' => 'Minuman',
        ]);

        $response = $this->put(route('foods.update', $food), [
            'name' => 'Susu Segar',
            'quantity' => '2',
            'purchase_date' => '2026-09-06',
            'shelf_life_days' => 5,
            'category' => 'Dairy',
        ]);

        $response->assertRedirect(route('foods.index'));
        $response->assertSessionHas('success', 'Makanan berhasil diperbarui.');

        $this->assertDatabaseHas('foods', [
            'id' => $food->id,
            'name' => 'Susu Segar',
            'quantity' => '2',
            'shelf_life_days' => 5,
            'category' => 'Dairy',
        ]);

        $this->assertSame(
            '2026-09-06',
            Food::find($food->id)->purchase_date->toDateString()
        );
    }

    public function test_food_can_be_deleted(): void
    {
        $food = Food::create([
            'name' => 'Bayam',
            'quantity' => '2',
            'purchase_date' => '2026-08-30',
            'shelf_life_days' => 2,
            'category' => 'Sayur',
        ]);

        $response = $this->delete(route('foods.destroy', $food));

        $response->assertRedirect(route('foods.index'));
        $response->assertSessionHas('success', 'Makanan berhasil dihapus.');

        $this->assertDatabaseMissing('foods', [
            'id' => $food->id,
            'name' => 'Bayam',
        ]);
    }

    public function test_update_food_requires_valid_input(): void
    {
        $food = Food::create([
            'name' => 'Bayam',
            'quantity' => '2',
            'purchase_date' => '2026-08-30',
            'shelf_life_days' => 2,
            'category' => 'Sayur',
        ]);

        $response = $this->from(route('foods.edit', $food))->put(route('foods.update', $food), [
            'name' => '',
            'quantity' => '',
            'purchase_date' => '',
            'shelf_life_days' => '',
            'category' => '',
        ]);

        $response->assertRedirect(route('foods.edit', $food));
        $response->assertSessionHasErrors([
            'name',
            'quantity',
            'purchase_date',
            'shelf_life_days',
            'category',
        ]);
    }
}
