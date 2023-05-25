<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProdutoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Api\PassportAuthController;
use App\Http\Controllers\Api\CategoriaController;

|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//rota para api Listar produtos
Route::apiResource('produtos', ProdutoController::class);

Route::post('/login', [LoginController::class, 'login']);
Route::post('/cadastro', [LoginController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:api');
Route::get('/user', [LoginController::class, 'userInfo'])->middleware('auth:api');

//rota para api Listar categorias
Route::apiResource('categorias', CategoriaController::class);

//rota para api Produtos por categoria
Route::apiResource('categorias/{id}/produtos', 'CategoriaController@produtosPorCategoria');
