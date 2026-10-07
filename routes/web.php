<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

// Centralized Desktop routes
Route::get('/', function () {
    return view('desktop', ['activeApp' => null]);
})->name('desktop');

Route::get('/clientes', function () {
    return view('desktop', ['activeApp' => 'clientes']);
})->name('clientes.index');

Route::get('/produtos', function () {
    return view('desktop', ['activeApp' => 'produtos']);
})->name('produtos.index');

Route::get('/descontos', function () {
    return view('desktop', ['activeApp' => 'descontos']);
})->name('descontos.index');

Route::get('/promocoes', function () {
    return view('desktop', ['activeApp' => 'promocoes']);
})->name('promocoes.index');

Route::get('/precos', function () {
    return view('desktop', ['activeApp' => 'precos']);
})->name('precos.index');

Route::get('/pedidos', function () {
    return view('desktop', ['activeApp' => 'pedidos']);
})->name('pedidos.index');

Route::get('/pagamentos', function () {
    return view('desktop', ['activeApp' => 'pagamentos']);
})->name('pagamentos.index');

Route::get('/storage-files/{path}', function (string $path) {
    abort_unless(Storage::disk('public')->exists($path), 404);

    return Storage::disk('public')->response($path);
})->where('path', '.*')->name('storage.public');
