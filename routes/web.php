<?php

use App\Http\Controllers\PessoaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleMapsController;

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

Route::get('/',[GoogleMapsController::class, 'index']);
// Route::post('/api/cadastrar', [PessoaController::class, 'cadastrar']);
