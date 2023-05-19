<?php

use App\Http\Controllers\CarsController;
use App\Http\Controllers\ClientsController;
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
    return view('welcome');
});

Route::get('/cars', [CarsController::class, "index"]);
Route::get('/cars/edit/{id}', [CarsController::class, "edit"]);
Route::post('/cars/update/{id}', [CarsController::class, "update"]);
Route::get('/cars/create', [CarsController::class, "create"]);
Route::post('/cars/create', [CarsController::class, "addToDB"]);
Route::get('/cars/delete/{id}', [CarsController::class, "delete"]);

Route::get('/clients', [ClientsController::class, "index"]);
Route::get('/clients/edit/{id}', [ClientsController::class, "edit"]);
Route::post('/clients/update/{id}', [ClientsController::class, "update"]);
Route::get('/clients/create', [ClientsController::class, "create"]);
Route::post('/clients/create', [ClientsController::class, "addToDB"]);
Route::get('/clients/delete/{id}', [ClientsController::class, "delete"]);
