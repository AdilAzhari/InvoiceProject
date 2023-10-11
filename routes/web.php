<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Customers_Report;
use App\Http\Controllers\InvoiceAchiveController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\invoices_details;
use App\Http\Controllers\Invoices_Report;
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

Route::resource('invoices', InvoiceController::class);

Route::resource('sections', SectionsController::class);

Route::resource('products', ProductsController::class);

Route::resource('InvoiceAttachments', InvoiceAttachmentsController::class);

Route::resource('InvoicesDetails', InvoicesDetailsController::class);

Route::resource('Archive', InvoiceAchiveController::class);

Route::group(['middleware' => ['auth']], function() {

Route::resource('roles','RoleController');

Route::resource('users','UserController');

});

Route::controller(invoices_details::class)->group(function () {
    Route::get('/InvoicesDetails/{id}', 'edit');
    Route::get('download/{invoice_number}/{file_name}', 'get_file');
    Route::get('View_file/{invoice_number}/{file_name}', 'open_file');
    Route::post('delete_file', 'destroy')->name('delete_file');
});


Route::controller(Invoices_Report::class)->group(function () {
    Route::get('/invoices_report', 'index');
    Route::post('/Search_invoices', 'Search_invoices');
});

Route::controller(Customers_Report::class)->group(function () {
    Route::get('/customers_report', 'index')->name("customers_report");
    Route::post('/Search_customers', 'Search_customers');
});

Route::controller(InvoiceController::class)->group(function () {
    Route::get('/MarkAsRead_all', 'MarkAsRead_all')->name("MarkAsRead_all");
    Route::get('/unreadNotifications_count', 'unreadNotifications_count')->name('unreadNotifications_count');
    Route::get('unreadNotifications', 'unreadNotifications')->name('unreadNotifications');
    Route::get('/section/{id}', 'getproducts');
    Route::get('/edit_invoice/{id}', 'edit');
    Route::get('/Status_show/{id}', 'show')->name('Status_show');
    Route::post('/Status_Update/{id}', 'Status_Update')->name('Status_Update');
    Route::get('Invoice_Paid','Invoice_Paid')->name('paid_invoices');
    Route::get('Invoice_UnPaid','Invoice_UnPaid')->name('UnPaid_invoices');
    Route::get('Invoice_Partial','Invoice_Partial')->name('invoices_partially_paid');
    Route::get('Print_invoice/{id}','Print_invoice');
    Route::get('export_invoices', 'export');

});

// Route::get('/{page}', 'AdminController@index');
