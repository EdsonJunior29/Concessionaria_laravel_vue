<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\CarroController;
use App\Http\Controllers\LocacaoController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1') -> middleware('jwt.auth')-> group(function () {

    Route::prefix('/cliente')->group(function () {
        Route::get('/', [ClienteController::class, 'index']);
        Route::post('/', [ClienteController::class, 'store']);
        Route::get('/{cliente}', [ClienteController::class, 'show']);
        Route::put('/{cliente}', [ClienteController::class, 'update']);
        Route::patch('/{cliente}', [ClienteController::class, 'update']);
        Route::delete('/{cliente}', [ClienteController::class, 'destroy']);
    });

    Route::prefix('/marca')->group(function () {
        Route::get('/', [MarcaController::class, 'index']);
        Route::post('/', [MarcaController::class, 'store']);
        Route::get('/{marca}', [MarcaController::class, 'show']);
        Route::put('/{marca}', [MarcaController::class, 'update']);
        Route::patch('/{marca}', [MarcaController::class, 'update']);
        Route::delete('/{marca}', [MarcaController::class, 'destroy']);
    });

    Route::prefix('/modelo')->group(function () {
        Route::get('/', [ModeloController::class, 'index']);
        Route::post('/', [ModeloController::class, 'store']);
        Route::get('/{modelo}', [ModeloController::class, 'show']);
        Route::put('/{modelo}', [ModeloController::class, 'update']);
        Route::patch('/{modelo}', [ModeloController::class, 'update']);
        Route::delete('/{modelo}', [ModeloController::class, 'destroy']);
    });

    Route::prefix('/carro')->group(function () {
        Route::get('/', [CarroController::class, 'index']);
        Route::post('/', [CarroController::class, 'store']);
        Route::get('/{carro}', [CarroController::class, 'show']);
        Route::put('/{carro}', [CarroController::class, 'update']);
        Route::patch('/{carro}', [CarroController::class, 'update']);
        Route::delete('/{carro}', [CarroController::class, 'destroy']);
    });

    Route::prefix('/locacao')->group(function () {
        Route::get('/', [LocacaoController::class, 'index']);
        Route::post('/', [LocacaoController::class, 'store']);
        Route::get('/{locacao}', [LocacaoController::class, 'show']);
        Route::put('/{locacao}', [LocacaoController::class, 'update']);
        Route::patch('/{locacao}', [LocacaoController::class, 'update']);
        Route::delete('/{locacao}', [LocacaoController::class, 'destroy']);
    });
});

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('refresh', [AuthController::class, 'refresh']);
Route::post('me', [AuthController::class, 'me']);
