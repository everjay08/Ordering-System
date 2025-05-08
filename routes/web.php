<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShopTableController;
use App\Http\Controllers\TableReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderMenuItemController;
use App\Http\Controllers\Auth\LoginController;
use App\Models\OrderMenuItem;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/', '/admin');

//MenuItem
Route::get('/api/menu-items', [MenuItemController::class, 'index']);
Route::post('/api/menu-item', action: [MenuItemController::class, 'store']);
Route::get('/api/menu-item/{id}', [MenuItemController::class, 'show']);
Route::patch('/api/menu-item/{id}', [MenuItemController::class, 'update']);
Route::delete('/api/menu-item/{id}', [MenuItemController::class, 'destroy']);

//Order
Route::get('/api/order-delivery-items', [OrderController::class, 'index']);
Route::post('/api/order-delivery-item', action: [OrderController::class, 'store']);
Route::get('/api/order-delivery-item/{id}', [OrderController::class, 'show']);
Route::patch('/api/order-delivery-item/{id}', [OrderController::class, 'update']);
Route::delete('/api/order-delivery-item/{id}', [OrderController::class, 'destroy']);

Route::get('/api/order-items', [OrderMenuItem::class, 'index']);
Route::post('/api/order-item', action: [OrderMenuItem::class, 'store']);
Route::get('/api/order-item/{id}', [OrderMenuItem::class, 'show']);
Route::patch('/api/order-item/{id}', [OrderMenuItem::class, 'update']);
Route::delete('/api/order-item/{id}', [OrderMenuItem::class, 'destroy']);

//ShopTable
Route::get('/api/shop-tables', [ShopTableController::class, 'index']);
Route::post('/api/shop-table', action: [ShopTableController::class, 'store']);
Route::get('/api/shop-table/{id}', [ShopTableController::class, 'show']);
Route::patch('/api/shop-table/{id}', [ShopTableController::class, 'update']);
Route::delete('/api/shop-table/{id}', [ShopTableController::class, 'destroy']);

//TableReservation
Route::get('/api/shop-table-reservations', action: [TableReservationController::class, 'index']);
Route::post('/api/shop-table-reservation', action: [TableReservationController::class, 'store']);
Route::get('/api/shop-table-reservation/{id}', [TableReservationController::class, 'show']);
Route::patch('/api/shop-table-reservation/{id}', [TableReservationController::class, 'update']);
Route::delete('/api/shop-table-reservation/{id}', [TableReservationController::class, 'destroy']);


//Users
Route::get('/api/Users', [UserController::class, 'index']);
Route::post('/api/User', action: [UserController::class, 'store']);
Route::get('/api/User/{id}', [UserController::class, 'show']);
Route::patch('/api/User/{id}', [UserController::class, 'update']);
Route::delete('/api/User/{id}', [UserController::class, 'destroy']);



Route::get('/api/logins', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('api/login/user', [LoginController::class, 'Userlogin']);
Route::post('api/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('api/register', [LoginController::class, 'showRegisterForm'])->name('register');
Route::post('api/register', [LoginController::class, 'register']);