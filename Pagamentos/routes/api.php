<?php

use App\Http\Controllers\Api\ClienteApiController;
use App\Http\Controllers\Api\DescontoApiController;
use App\Http\Controllers\Api\PagamentoApiController;
use App\Http\Controllers\Api\PedidoApiController;
use App\Http\Controllers\Api\PrecoApiController;
use App\Http\Controllers\Api\ProdutoApiController;
use App\Http\Controllers\Api\PromocaoApiController;
use Illuminate\Support\Facades\Route;

Route::apiResource('clientes', ClienteApiController::class)->names('api.clientes');
Route::apiResource('produtos', ProdutoApiController::class)->names('api.produtos');
Route::apiResource('precos', PrecoApiController::class)->names('api.precos');
Route::apiResource('promocoes', PromocaoApiController::class)->parameters(['promocoes' => 'promocao'])->names('api.promocoes');
Route::apiResource('descontos', DescontoApiController::class)->names('api.descontos');
Route::apiResource('pagamentos', PagamentoApiController::class)->withTrashed(['show'])->names('api.pagamentos');
Route::apiResource('pedidos', PedidoApiController::class)->names('api.pedidos');
