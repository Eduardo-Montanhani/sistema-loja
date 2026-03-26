<?php


namespace App\Observers;

use App\Models\Produto;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class ProdutoObserver
{
    public function created(Produto $produto)
    {
        Log::create([
            'user_id' => Auth::id(),
            'acao' => 'CRIAR',
            'descricao' => 'Criou produto: ' . $produto->nome
        ]);
    }

    public function updated(Produto $produto)
    {
        Log::create([
            'user_id' => Auth::id(),
            'acao' => 'EDITAR',
            'descricao' => 'Editou produto: ' . $produto->nome
        ]);
    }

    public function deleted(Produto $produto)
    {
        Log::create([
            'user_id' => Auth::id(),
            'acao' => 'EXCLUIR',
            'descricao' => 'Excluiu produto: ' . $produto->nome
        ]);
    }
}
