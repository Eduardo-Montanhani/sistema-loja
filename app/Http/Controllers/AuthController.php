<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credenciais = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credenciais)) {

            $request->session()->regenerate();

            return redirect('/dashboard');
        }

        return back()->withErrors([
            'email' => 'email ou senha incorretos'
        ]);
    }


    public function dashboard()
    {
        $produtos = Produto::latest()->take(5)->get(); // últimos produtos

        // 🔢 TOTAL DE PRODUTOS (quantidade total em estoque)
        $totalProdutos = Produto::sum('quantidade');

        // 💰 VALOR TOTAL INVESTIDO (estoque)
        $valorEstoque = Produto::all()->sum(function ($produto) {
            return $produto->preco_compra * $produto->quantidade;
        });

        // 💸 DESPESAS
        $despesas = Despesa::all();
        $totalDespesas = $despesas->sum('valor');

        // 💵 LUCRO DAS VENDAS
        $lucroTotal = 0;
        foreach (Produto::where('vendido', true)->get() as $produto) {
            $lucroTotal += ($produto->preco_venda - $produto->preco_compra);
        }

        // 🧾 LUCRO REAL
        $lucroReal = $lucroTotal - $totalDespesas;

        return view('dashboard', compact(
            'produtos',
            'totalProdutos',
            'valorEstoque',
            'lucroTotal',
            'totalDespesas',
            'lucroReal'
        ));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
