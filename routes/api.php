<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MarcaController;
use App\Models\Cliente;
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

Route::prefix('/cliente')->group(function () {
    Route::get('/', [ClienteController::class, 'index']);
    Route::post('/', [ClienteController::class, 'store']);
    Route::delete('/{id}', [ClienteController::class, 'destroy']);
});

Route::prefix('/marca')->group(function () {
    Route::get('/', [MarcaController::class, 'index']);
    Route::post('/', [MarcaController::class, 'store']);
    Route::get('/{marca}', [MarcaController::class, 'show']);
    Route::put('/{marca}', [MarcaController::class, 'update']);
    Route::patch('/{marca}', [MarcaController::class, 'update']);
    Route::delete('/{marca}', [MarcaController::class, 'destroy']);
});
