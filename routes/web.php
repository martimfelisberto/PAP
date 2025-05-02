<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ArtigoController;
use App\Models\Artigo;


use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\DashboardController
;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/contactos', function () {
    return view('contactos');

});
Route::get('/produtos/{id}', [ArtigoController::class, 'show'])->name('produtos.detalhes');

// Rotas do Carrinho
Route::get('/carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');
Route::post('/carrinho/adicionar', [CarrinhoController::class, 'adicionar'])->name('carrinho.adicionar');
Route::delete('/carrinho/remover/{id}', [CarrinhoController::class, 'remover'])->name('carrinho.remover');
Route::patch('/carrinho/atualizar/{id}', [CarrinhoController::class, 'atualizar'])->name('carrinho.atualizar');
Route::delete('/carrinho/limpar', [CarrinhoController::class, 'limpar'])->name('carrinho.limpar');

require __DIR__ . '/auth.php';

Route::post('/artigos', [ArtigoController::class, 'store'])->name('artigos.store');
Route::delete('/artigos/{artigo}', [ArtigoController::class, 'destroy'])->name('artigos.destroy');
Route::get('/artigos/create', [ArtigoController::class, 'create'])->name('artigos.create');
Route::get('/artigos/{genero?}', [ArtigoController::class, 'index'])->name('artigos.index');

Route::get('/homem/casacos', [ArtigoController::class, 'homem'])->name('homem.casacos');
Route::get('/homem/calcas', [ArtigoController::class, 'homem'])->name('homem.calcas');
Route::get('/homem/camisolas', [ArtigoController::class, 'homem'])->name('homem.camisolas');
Route::get('/homem/tshirts', [ArtigoController::class, 'homem'])->name('homem.camisolas');
Route::get('/homem/sapatilhas', [ArtigoController::class, 'homem'])->name('homem.camisolas');

Route::get('/mulher/casacos', [ArtigoController::class, 'mulher'])->name('mulher.casacos');
Route::get('/mulher/calcas', [ArtigoController::class, 'mulher'])->name('mulher.calcas');
Route::get('/mulher/camisolas', [ArtigoController::class, 'mulher'])->name('mulher.camisolas');
Route::get('/mulher/sapatilhas', [ArtigoController::class, 'mulher'])->name('mulher.sapatilhas');
Route::get('/mulher/tshirts', [ArtigoController::class, 'mulher'])->name('mulher.tshirts');

Route::get('/crianca/casacos', [ArtigoController::class, 'crianca'])->name('crianca.casacos');
Route::get('/crianca/camisolas', [ArtigoController::class, 'crianca'])->name('crianca.camisolas');
Route::get('/crianca/calcas', [ArtigoController::class, 'crianca'])->name('crianca.calcas');
Route::get('/crianca/sapatilhas', [ArtigoController::class, 'crianca'])->name('crianca.sapatilhas');
Route::get('/crianca/tshirts', [ArtigoController::class, 'crianca'])->name('crianca.tshirts');