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
// Default laravel page
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Dashboard Route
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('index');

    Route::get('/alerts', function () {
        return view('admin.pages.alerts');
    })->name('alerts');

    Route::get('/buttons', function () {
        return view('admin.pages.buttons');
    })->name('buttons');

    Route::get('/dropdowns', function () {
        return view('admin.pages.dropdowns');
    })->name('dropdowns');

    Route::get('/modals', function () {
        return view('admin.pages.modals');
    })->name('modals');

    Route::get('/popovers', function () {
        return view('admin.pages.popovers');
    })->name('popovers');

    Route::get('/progress-bars', function () {
        return view('admin.pages.progress-bars');
    })->name('progress-bars');

    Route::get('/forms-basic', function () {
        return view('admin.pages.forms-basic');
    })->name('forms-basic');

    Route::get('/forms-advanced', function () {
        return view('admin.pages.forms-advanced');
    })->name('forms-advanced');

    Route::get('/simple-table', function () {
        return view('admin.pages.simple-table');
    })->name('simple-table');

    Route::get('/datatables', function () {
        return view('admin.pages.datatables');
    })->name('datatables');

    Route::get('/ui-colours', function () {
        return view('admin.pages.ui-colours');
    })->name('ui-colours');

    Route::get('/404', function () {
        return view('admin.pages.404');
    })->name('404');

    Route::get('/blank-page', function () {
        return view('admin.pages.blank-page');
    })->name('blank-page');

    Route::get('/charts', function () {
        return view('admin.pages.charts');
    })->name('charts');
});
