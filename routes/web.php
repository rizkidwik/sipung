<?php

use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return redirect('backend');
});

// Route::get('/', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified', 'cekRole'])->name('dashboard');

Route::prefix('backend')->group(function () {
    require_once __DIR__ . '/admin/admin.php';
    require __DIR__ . '/auth.php';
});

