<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\PedidoController;     
use App\Http\Controllers\ItemPedidoController; 

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('produtos')->group(function () {
    Route::get('/', [ProdutosController::class, 'index']);
    Route::post('/', [ProdutosController::class, 'store']);
    Route::get('/{id}', [ProdutosController::class, 'show']);
    Route::put('/{id}', [ProdutosController::class, 'update']);
    Route::delete('/{id}', [ProdutosController::class, 'destroy']);
});


Route::apiResource('pedidos', PedidoController::class);
Route::apiResource('pedidos.itens', ItemPedidoController::class)->shallow();