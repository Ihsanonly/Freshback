<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $foods = [
            [
                'name' => 'Telur',
                'quantity' => '6',
                'purchase_date' => '2026-09-05',
                'shelf_life_days' => 7,
                'category' => 'Protein',
                'notes' => 'Contoh data awal',
            ],
            [
                'name' => 'Milo',
                'quantity' => '1',
                'purchase_date' => '2026-09-04',
                'shelf_life_days' => 30,
                'category' => 'Minuman',
                'notes' => 'Contoh data awal',
            ],
            [
                'name' => 'Roti',
                'quantity' => '2',
                'purchase_date' => '2026-09-03',
                'shelf_life_days' => 5,
                'category' => 'Karbohidrat',
                'notes' => 'Contoh data awal',
            ],
            [
                'name' => 'Susu',
                'quantity' => '1',
                'purchase_date' => '2026-09-02',
                'shelf_life_days' => 4,
                'category' => 'Minuman',
                'notes' => 'Contoh data awal',
            ],
            [
                'name' => 'Pisang',
                'quantity' => '5',
                'purchase_date' => '2026-09-01',
                'shelf_life_days' => 3,
                'category' => 'Buah',
                'notes' => 'Contoh data awal',
            ],
            [
                'name' => 'Ayam',
                'quantity' => '1',
                'purchase_date' => '2026-08-31',
                'shelf_life_days' => 2,
                'category' => 'Protein',
                'notes' => 'Contoh data awal',
            ],
            [
                'name' => 'Bayam',
                'quantity' => '2',
                'purchase_date' => '2026-08-30',
                'shelf_life_days' => 2,
                'category' => 'Sayur',
                'notes' => 'Contoh data awal',
            ],
            [
                'name' => 'Tahu',
                'quantity' => '4',
                'purchase_date' => '2026-08-29',
                'shelf_life_days' => 4,
                'category' => 'Protein',
                'notes' => 'Contoh data awal',
            ],
            [
                'name' => 'Tempe',
                'quantity' => '3',
                'purchase_date' => '2026-08-28',
                'shelf_life_days' => 4,
                'category' => 'Protein',
                'notes' => 'Contoh data awal',
            ],
            [
                'name' => 'Wortel',
                'quantity' => '6',
                'purchase_date' => '2026-08-27',
                'shelf_life_days' => 10,
                'category' => 'Sayur',
                'notes' => 'Contoh data awal',
            ],
            [
                'name' => 'Keju',
                'quantity' => '1',
                'purchase_date' => '2026-08-26',
                'shelf_life_days' => 14,
                'category' => 'Dairy',
                'notes' => 'Contoh data awal',
            ],
            [
                'name' => 'Apel',
                'quantity' => '8',
                'purchase_date' => '2026-08-25',
                'shelf_life_days' => 12,
                'category' => 'Buah',
                'notes' => 'Contoh data awal',
            ],
        ];

        foreach ($foods as $food) {
            Food::updateOrCreate(
                ['name' => $food['name']],
                $food
            );
        }
    }
}
