<?php

namespace Tests\Unit;

use App\Models\Food;
use PHPUnit\Framework\TestCase;

class FoodModelTest extends TestCase
{
    public function test_food_model_uses_foods_table(): void
    {
        $food = new Food();

        $this->assertSame('foods', $food->getTable());
        $this->assertContains('name', $food->getFillable());
        $this->assertContains('purchase_date', $food->getFillable());
        $this->assertSame('date', $food->getCasts()['purchase_date']);
    }
}
