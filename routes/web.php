<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\invoices_details;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SectionsController;
use App\Models\products;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});


Route::get('users', [AdminController::class, 'show'])->name('user.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('invoices', InvoiceController::class);

Route::resource('sections', SectionsController::class);

Route::resource('products', ProductsController::class);

Route::controller(invoiceController::class)->group(function () {
    Route::get('/section/{id}', 'getProducts');
});

Route::controller(invoices_details::class)->group(function () {
    Route::get('/InvoicesDetails/{id}', 'edit');
});
