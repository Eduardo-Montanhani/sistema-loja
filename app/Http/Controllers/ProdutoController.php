<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Listar produtos
     */
    public function index()
    {
        $produtos = Produto::all();
        return view('produtos.index', compact('produtos'));
    }

    /**
     * Mostrar formulário de criação
     */
    public function create()
    {
        return view('produtos.create');
    }

    /**
     * Salvar produto no banco
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco_compra' => 'required|numeric|min:0',
            'preco_venda' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
        ]);

        Produto::create([
            'nome' => $request->nome,
            'preco_compra' => $request->preco_compra,
            'preco_venda' => $request->preco_venda,
            'quantidade' => $request->quantidade,
        ]);

        return redirect()->route('produtos.index')
            ->with('success', 'Produto cadastrado com sucesso!');
    }

    /**
     * Mostrar um produto
     */
    public function show(Produto $produto)
    {
        return view('produtos.show', compact('produto'));
    }

    /**
     * Mostrar formulário de edição
     */
    public function edit($id)
    {
        $produto = Produto::findOrFail($id);

        return view('produtos.edit', compact('produto'));
    }
    /**
     * Atualizar produto
     */
    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco_compra' => 'required|numeric|min:0',
            'preco_venda' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
        ]);

        $produto->update([
            'nome' => $request->nome,
            'preco_compra' => $request->preco_compra,
            'preco_venda' => $request->preco_venda,
            'quantidade' => $request->quantidade,
        ]);

        return redirect()->route('produtos.index')
            ->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Deletar produto
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();

        return redirect()->route('produtos.index')
            ->with('success', 'Produto removido com sucesso!');
    }
}
