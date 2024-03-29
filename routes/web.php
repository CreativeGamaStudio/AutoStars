<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/settings', [App\Http\Controllers\HomeController::class, 'settings'])->name('settings');

Route::resource('items', App\Http\Controllers\ItemController::class, [
    'except' => ['show']
]);

// Route::resource('clients', App\Http\Controllers\ClientController::class);

Route::resource('invoices', App\Http\Controllers\InvoiceController::class, [
    'except' => [ 'show' ]
]);


Route::resource('users', App\Http\Controllers\UserController::class, [
    'except' => ['show']
]);


Route::resource('customers', App\Http\Controllers\CustomerController::class, [
    'except' => ['show']
]);

Route::resource('services', App\Http\Controllers\ServiceController::class);

Route::resource('employees', App\Http\Controllers\EmployeeController::class, [
    'except' => ['show']
]);


Route::resource('vehicles', App\Http\Controllers\VehicleController::class);

Route::resource('parts', App\Http\Controllers\PartController::class);

Route::resource('registrations', App\Http\Controllers\RegistrationController::class);

Route::resource('orders', App\Http\Controllers\OrderController::class);

Route::resource('payments', App\Http\Controllers\PaymentController::class, [
    'except' => ['show']
]);

Route::resource('notes', App\Http\Controllers\NoteController::class);

Route::resource('return_notes', App\Http\Controllers\ReturnNoteController::class, [
    'except' => ['show']
]);

