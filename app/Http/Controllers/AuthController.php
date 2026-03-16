<?php

namespace App\Http\Controllers;

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
        $produtos = Produto::latest()->take(5)->get();
        $totalProdutos = Produto::count();
        $valorEstoque = Produto::sum('preco_venda');

        return view('dashboard', compact(
            'produtos',
            'totalProdutos',
            'valorEstoque'
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
