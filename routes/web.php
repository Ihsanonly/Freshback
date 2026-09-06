<?php

use App\Http\Controllers\FoodController;
use App\Models\Food;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/foods/create', [FoodController::class, 'create'])->name('foods.create');
Route::post('/foods', [FoodController::class, 'store'])->name('foods.store');
Route::get('/foods', [FoodController::class, 'index'])->name('foods.index');

Route::get('/test-db', function () {
    try {
        $connection = DB::connection();
        $databaseName = $connection->getDriverName() === 'mysql'
            ? (DB::selectOne('SELECT DATABASE() AS name')->name ?? '-')
            : $connection->getDatabaseName();

        return view('test-db', [
            'message' => 'Koneksi database Laravel berhasil.',
            'databaseName' => $databaseName,
            'totalFoods' => Food::count(),
            'modelName' => Food::class,
            'isSuccess' => true,
        ]);
    } catch (Throwable $exception) {
        return view('test-db', [
            'message' => 'Koneksi database gagal atau tabel foods belum tersedia.',
            'databaseName' => '-',
            'totalFoods' => '-',
            'modelName' => Food::class,
            'isSuccess' => false,
        ]);
    }
});
