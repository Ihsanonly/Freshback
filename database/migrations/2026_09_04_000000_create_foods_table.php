<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('foods')) {
            return;
        }

        Schema::create('foods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('quantity', 50);
            $table->date('purchase_date');
            $table->unsignedInteger('shelf_life_days');
            $table->string('category', 50)->nullable()->index();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('purchase_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};
