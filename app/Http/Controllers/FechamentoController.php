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
        $vendas = Produto::where('vendido', true)->get();
        $despesas = Despesa::all();

        $totalVendas = $vendas->sum('preco_venda');
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
        $vendas = Produto::where('vendido', true)->get();
        $despesas = Despesa::all();

        $totalVendas = $vendas->sum('preco_venda');
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
