<?php

namespace App\Providers;

use App\Models\Despesa;
use App\Models\Produto;
use App\Observers\DespesaObserver;
use App\Observers\ProdutoObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Produto::observe(ProdutoObserver::class);
        Despesa::observe(DespesaObserver::class);
    }
}
