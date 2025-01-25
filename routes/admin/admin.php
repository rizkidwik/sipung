<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RoleMenusController;
use App\Http\Controllers\Backend\ConfigurationController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\CategorySettingControler;
use App\Http\Controllers\Backend\DonaturController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\TransactionController;
use Illuminate\Support\Facades\Route;


Route::get('/', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('/dashboard/table', [DashboardController::class, 'tableDashboard'])->middleware('auth')->name('dashboard.table');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/getRole', [ProfileController::class, 'getRole'])->name('profile.getRole');
    Route::post('/profile/updatePassword', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::post('/update-avatar',[ProfileController::class, 'updateAvatar'])->name('profile.updateAvatar');
});

Route::middleware(['auth','cekRole'])->group(function () {

    Route::prefix('role-menu')->group(function () {
        foreach (['index', 'table'] as $key => $value) {
            Route::get($value == 'index' ? '/' : $value, [RoleMenusController::class, $value])->name('role.' . $value);
        }
        foreach (['store', 'show', 'destroy', 'saveRoleMenu', 'showRole'] as $key => $value) {
            Route::post($value == 'store' ? '/' : $value, [RoleMenusController::class, $value])->name('role.' . $value);
        }
    });

    Route::prefix('configuration')->group(function () {
        foreach (['index', 'getConfig','logo'] as $key => $value) {
            Route::get($value == 'index' ? '/' : $value, [ConfigurationController::class, $value])->name('configuration.' . $value);
        }
        foreach (['store', 'show', 'destroy', 'uploadLogo'] as $key => $value) {
            Route::post($value == 'store' ? '/' : $value, [ConfigurationController::class, $value])->name('configuration.' . $value);
        }
    });

    Route::prefix('user')->group(function () {
        foreach (['index', 'table', 'getRoles'] as $key => $value) {
            Route::get($value == 'index' ? '/' : $value, [UserController::class, $value])->name('user.' . $value);
        }
        foreach (['store', 'show', 'destroy'] as $key => $value) {
            Route::post($value == 'store' ? '/' : $value, [UserController::class, $value])->name('user.' . $value);
        }
    });

    Route::prefix('category')->group(function () {
        foreach (['index', 'table'] as $key => $value) {
            Route::get($value == 'index' ? '/' : $value, [CategoryController::class, $value])->name('category.' . $value);
        }
        foreach (['store', 'show', 'destroy'] as $key => $value) {
            Route::post($value == 'store' ? '/' : $value, [CategoryController::class, $value])->name('category.' . $value);
        }
    });

    Route::prefix('donatur')->group(function () {
        foreach (['index', 'table'] as $key => $value) {
            Route::get($value == 'index' ? '/' : $value, [DonaturController::class, $value])->name('donatur.' . $value);
        }
        foreach (['store', 'show', 'destroy'] as $key => $value) {
            Route::post($value == 'store' ? '/' : $value, [DonaturController::class, $value])->name('donatur.' . $value);
        }
    });

    Route::prefix('transaction')->group(function () {
        foreach (['index', 'table','getDonatur','getCategory'] as $key => $value) {
            Route::get($value == 'index' ? '/' : $value, [TransactionController::class, $value])->name('transaction.' . $value);
        }
        foreach (['store', 'show', 'destroy','detailDonatur'] as $key => $value) {
            Route::post($value == 'store' ? '/' : $value, [TransactionController::class, $value])->name('transaction.' . $value);
        }
        Route::get('/print/{id}', [TransactionController::class, 'print'])->name('transaction.print');
    });

    Route::prefix('report')->group(function () {
        foreach (['index', 'table'] as $key => $value) {
            Route::get($value == 'index' ? '/' : $value, [ReportController::class, $value])->name('report.' . $value);
        }
        foreach (['show'] as $key => $value) {
            Route::post($value == 'store' ? '/' : $value, [ReportController::class, $value])->name('report.' . $value);
        }
    });

    
});
