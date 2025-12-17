<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SinhVienController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PageController::class, 'showHomepage']);
Route::get('/about', [PageController::class, 'showHomepage']);


//  Route::get('/sinhvien', [SinhVienController::class, 'index'])->name('sinhvien.index');
//  Route::post('/sinhvien', [SinhVienController::class, 'store'])->name('sinhvien.store'); 


// Gợi ý:
Route::middleware(['auth'])->group(function () {
    Route::get('/sinhvien', [SinhVienController::class, 'index'])->name('sinhvien.index');
    Route::post('/sinhvien', [SinhVienController::class, 'store'])->name('sinhvien.store');
});
// 'auth' là middleware kiểm tra xác thực 