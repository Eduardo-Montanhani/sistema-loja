<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produto;
use App\Models\Despesa;
use Barryvdh\DomPDF\Facade\Pdf;

class FechamentoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        $despesas = Despesa::all();

        // pegar só quem vendeu algo
        $vendas = $produtos->where('quantidade_vendida', '>', 0);

        $totalVendas = 0;

        foreach ($vendas as $p) {
            $totalVendas += $p->preco_venda * $p->quantidade_vendida;
        }

        $totalDespesas = $despesas->sum('valor');

        $lucro = $totalVendas - $totalDespesas;

        return view('fechamento.index', compact(
            'vendas',
            'despesas',
            'totalVendas',
            'totalDespesas',
            'lucro'
        ));
    }
    public function pdf()
    {
        $produtos = Produto::all();
        $despesas = Despesa::all();

        $vendas = $produtos->where('quantidade_vendida', '>', 0);

        $totalVendas = 0;

        foreach ($vendas as $p) {
            $totalVendas += $p->preco_venda * $p->quantidade_vendida;
        }

        $totalDespesas = $despesas->sum('valor');

        $lucro = $totalVendas - $totalDespesas;

        $pdf = Pdf::loadView('fechamento.pdf', compact(
            'vendas',
            'despesas',
            'totalVendas',
            'totalDespesas',
            'lucro'
        ));

        return $pdf->download('fechamento.pdf');
    }
}
