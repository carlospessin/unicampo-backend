<?php

use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\PessoaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(
    ['prefix' => 'pessoa'],
    function () {
        Route::get('listar/{id?}', [PessoaController::class, 'listar']);
        Route::post('cadastrar', [PessoaController::class, 'cadastrar']);
        Route::put('editar/{id?}', [PessoaController::class, 'editar']);
        Route::delete('deletar/{id?}', [PessoaController::class, 'deletar']);
    }
);

Route::get('endereco/{cep}', [EnderecoController::class, 'endereco']);
