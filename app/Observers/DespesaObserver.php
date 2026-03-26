<?php

namespace App\Observers;

use App\Models\Despesa;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class DespesaObserver
{
    public function created(Despesa $despesa)
    {
        Log::create([
            'user_id' => Auth::id(),
            'acao' => 'CRIAR',
            'descricao' => 'Criou despesa: ' . $despesa->nome . ' (R$ ' . $despesa->valor . ')'
        ]);
    }

    public function updated(Despesa $despesa)
    {
        Log::create([
            'user_id' => Auth::id(),
            'acao' => 'EDITAR',
            'descricao' => 'Editou despesa: ' . $despesa->nome
        ]);
    }

    public function deleted(Despesa $despesa)
    {
        Log::create([
            'user_id' => Auth::id(),
            'acao' => 'EXCLUIR',
            'descricao' => 'Excluiu despesa: ' . $despesa->nome . ' (R$ ' . $despesa->valor . ')'
        ]);
    }
}
