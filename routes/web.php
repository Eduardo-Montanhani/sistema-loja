<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DespesaController;
use App\Http\Controllers\FechamentoController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RelatorioController;
use Symfony\Component\HttpFoundation\Request;

Route::get('/', function () {
    return redirect('/login');
});
// ROTAS PÚBLICAS (não precisam login)

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);


// ROTAS PROTEGIDAS (precisam login)

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [AuthController::class, 'dashboard']);

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::resource('produtos', ProdutoController::class);

    Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');

    Route::patch('/produtos/{id}/vender', [ProdutoController::class, 'vender'])
        ->name('produtos.vender');

    Route::resource('despesas', DespesaController::class);

    Route::get('/fechamento', [FechamentoController::class, 'index'])->name('fechamento.index');

    Route::get('/fechamento/pdf', [FechamentoController::class, 'pdf'])->name('fechamento.pdf');

    Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
});
