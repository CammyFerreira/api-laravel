<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProdutoController;
use App\Http\Controllers\LoginController;

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
/*Route::post('/login', function (Request $request) {
    return $request->login();
});*/

Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login']);

//Route::apiResource('login', LoginController::class);
