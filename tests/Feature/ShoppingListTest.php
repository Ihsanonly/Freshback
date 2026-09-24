<?php

namespace Tests\Feature;

use App\Models\Food;
use App\Models\ShoppingList;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShoppingListTest extends TestCase
{
    use RefreshDatabase;

    public function test_shopping_list_page_can_be_opened(): void
    {
        $response = $this->get('/shopping-list');

        $response->assertOk();
        $response->assertSee('FRESHBACK');
        $response->assertSee('Daftar Belanja');
        $response->assertSee('Tambah Barang');
        $response->assertSee('Beranda');
        $response->assertSee('Belum ada barang di daftar belanja.');

        $response->assertSee(
            'href="' . route('dashboard') . '"',
            false
        );
    }

    public function test_store_adds_new_item_and_redirects_back(): void
    {
        $response = $this
            ->from('/foods')
            ->post('/shopping-list', [
                'item_name' => 'Beras 5 kg',
            ]);

        $response->assertRedirect('/foods');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('shopping_lists', [
            'item_name' => 'Beras 5 kg',
            'is_bought' => 0,
        ]);
    }

    public function test_store_validates_item_name(): void
    {
        $response = $this
            ->from('/shopping-list')
            ->post('/shopping-list', [
                'item_name' => '',
            ]);

        $response->assertRedirect('/shopping-list');
        $response->assertSessionHasErrors('item_name');

        $this->assertDatabaseCount('shopping_lists', 0);
    }

    public function test_toggle_marks_item_as_bought_and_back_again(): void
    {
        $item = ShoppingList::create([
            'item_name' => 'Telur',
        ]);

        $response = $this->patch("/shopping-list/{$item->id}/toggle");

        $response->assertRedirect();
        $this->assertTrue($item->fresh()->is_bought);

        $response = $this->patch("/shopping-list/{$item->id}/toggle");

        $response->assertRedirect();
        $this->assertFalse($item->fresh()->is_bought);
    }

    public function test_destroy_removes_item(): void
    {
        $item = ShoppingList::create([
            'item_name' => 'Gula',
        ]);

        $response = $this->delete("/shopping-list/{$item->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('shopping_lists', [
            'id' => $item->id,
        ]);
    }

    public function test_pending_items_are_shown_before_bought_items(): void
    {
        ShoppingList::create([
            'item_name' => 'Minyak Goreng',
            'is_bought' => true,
        ]);

        ShoppingList::create([
            'item_name' => 'Sabun Cuci',
            'is_bought' => false,
        ]);

        $response = $this->get('/shopping-list');

        $response->assertOk();
        $response->assertSee('Belum dibeli');
        $response->assertSee('Sudah dibeli');
        $response->assertSeeInOrder([
            'Sabun Cuci',
            'Minyak Goreng',
        ]);
    }

    public function test_expired_food_shows_shopping_list_button_on_foods_page(): void
    {
        Carbon::setTestNow('2026-09-20');

        try {
            Food::create([
                'name' => 'Yogurt Basi',
                'quantity' => '1',
                'purchase_date' => '2026-09-01',
                'shelf_life_days' => 5,
                'category' => 'Dairy',
            ]);

            Food::create([
                'name' => 'Apel Segar',
                'quantity' => '1',
                'purchase_date' => '2026-09-18',
                'shelf_life_days' => 10,
                'category' => 'Buah',
            ]);

            $response = $this->get('/foods');

            $response->assertOk();
            $response->assertSee('Masuk Daftar Belanja');
            $response->assertSee('Yogurt Basi');
        } finally {
            Carbon::setTestNow();
        }
    }

    public function test_safe_food_does_not_show_shopping_list_button(): void
    {
        Carbon::setTestNow('2026-09-20');

        try {
            Food::create([
                'name' => 'Apel Segar',
                'quantity' => '1',
                'purchase_date' => '2026-09-18',
                'shelf_life_days' => 10,
                'category' => 'Buah',
            ]);

            $response = $this->get('/foods');

            $response->assertOk();
            $response->assertDontSee('Masuk Daftar Belanja');
        } finally {
            Carbon::setTestNow();
        }
    }

    public function test_shopping_button_from_foods_page_creates_item(): void
    {
        Carbon::setTestNow('2026-09-20');

        try {
            Food::create([
                'name' => 'Roti Kadaluarsa',
                'quantity' => '1',
                'purchase_date' => '2026-09-01',
                'shelf_life_days' => 5,
                'category' => 'Karbohidrat',
            ]);

            $response = $this
                ->from('/foods')
                ->post('/shopping-list', [
                    'item_name' => 'Roti Kadaluarsa',
                ]);

            $response->assertRedirect('/foods');

            $this->assertDatabaseHas('shopping_lists', [
                'item_name' => 'Roti Kadaluarsa',
                'is_bought' => 0,
            ]);

            $listPage = $this->get('/shopping-list');
            $listPage->assertOk();
            $listPage->assertSee('Roti Kadaluarsa');
            $listPage->assertSee('Belum dibeli');
        } finally {
            Carbon::setTestNow();
        }
    }

    public function test_dashboard_has_shopping_list_quick_link(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Aksi cepat');
        $response->assertSee('Daftar Belanja');
        $response->assertSee('🛒');
    }
}
