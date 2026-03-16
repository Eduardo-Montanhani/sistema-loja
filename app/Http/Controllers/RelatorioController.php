<?php

namespace App\Http\Controllers;

use App\Models\Produto;

class RelatorioController extends Controller
{

    public function index()
    {

        $produtos = Produto::all();

        return view('relatorios.index', compact('produtos'));
    }
}
