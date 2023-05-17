<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProdutoController;
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\CarrinhoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//rota para api Listar produtos
Route::apiResource('produtos', ProdutoController::class);

//rota para api Listar categorias
Route::apiResource('categorias', CategoriaController::class);

//rota para api Adicionar carrinho
// Route::controller(CarrinhoController::class)->group(function () {
//     Route::get('/user/carrinho', 'show');
//     Route::post('/user/carrinho', 'store');
//     Route::patch('/user/carrinhos', 'update');
// });

Route::apiResource('carrinho', CarrinhoController::class); 