<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('shopping_lists')) {
            return;
        }

        Schema::create('shopping_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item_name', 100);
            $table->boolean('is_bought')->default(false);
            $table->timestamps();

            $table->index('is_bought');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shopping_lists');
    }
};
