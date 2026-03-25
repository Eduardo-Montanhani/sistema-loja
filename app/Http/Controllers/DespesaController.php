<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
use Illuminate\Http\Request;



class DespesaController extends Controller
{
    public function index()
    {
        $despesas = Despesa::latest()->get();

        return view('despesas.index', compact('despesas'));
    }

    public function create()
    {
        return view('despesas.create');
    }

    public function store(Request $request)
    {
        Despesa::create($request->all());

        return redirect()->route('despesas.index');
    }

    public function destroy(Request $request, $id)
    {
        // 🔐 senha mestre
        if ($request->master_password !== env('MASTER_PASSWORD')) {
            return redirect()->back()->with('erro', 'Senha mestre incorreta!');
        }

        $despesa = Despesa::findOrFail($id);
        $despesa->delete();

        return redirect()->route('despesas.index')
            ->with('success', 'Despesa excluída com sucesso!');
    }
}
