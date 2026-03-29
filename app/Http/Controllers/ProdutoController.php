<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'preco_compra' => 'required|numeric|min:1',
            'preco_venda' => 'required|numeric|min:1',
            'quantidade' => 'required|integer|min:1',
            'imagem' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:100000'
        ]);

        $imagemPath = null;

        if ($request->hasFile('imagem')) {
            $imagemPath = $request->file('imagem')->store('produtos', 'public');
        }

        Produto::create([
            'nome' => $request->nome,
            'preco_compra' => $request->preco_compra,
            'preco_venda' => $request->preco_venda,
            'quantidade' => $request->quantidade,
            'imagem' => $imagemPath
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


    public function edit(Request $request, $id)
    {
        $senha = $request->header('X-MASTER-PASSWORD');

        if (!$senha || !Hash::check($senha, Auth::user()->password)) {
            return redirect()->back()->with('erro', 'Senha incorreta!');
        }

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
            'preco_compra' => 'required|numeric|min:1',
            'preco_venda' => 'required|numeric|min:1',
            'imagem' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:100000'
        ]);

        $dados = [
            'nome' => $request->nome,
            'preco_compra' => $request->preco_compra,
            'preco_venda' => $request->preco_venda,
        ];

        if ($request->hasFile('imagem')) {

            // remove antiga (se existir)
            if ($produto->imagem) {
                Storage::disk('public')->delete($produto->imagem);
            }

            $dados['imagem'] = $request->file('imagem')->store('produtos', 'public');
        }

        $produto->update($dados);

        return redirect()->route('produtos.index')
            ->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Deletar produto
     */
    public function destroy(Request $request, Produto $produto)
    {
        if (!Hash::check($request->master_password, Auth::user()->password)) {
            return redirect()->back()->with('error', 'Senha incorreta!');
        }

        $produto->delete();

        return redirect()->back()->with('success', 'Produto excluído!');
    }

    public function vender($id)
    {
        $produto = Produto::findOrFail($id);

        if ($produto->quantidade > 0) {

            // diminui estoque
            $produto->quantidade -= 1;

            // soma quantidade vendida
            $produto->quantidade_vendida += 1;

            // opcional: marcar vendido quando zerar
            if ($produto->quantidade == 0) {
                $produto->vendido = true;
            }

            $produto->save();

            Log::create([
                'user_id' => Auth::id(),
                'tipo' => 'produto',
                'acao' => 'VENDA',
                'descricao' => 'Vendeu 1 unidade de: ' . $produto->nome
            ]);

            return redirect()->back()->with('success', 'Produto vendido!');
        }

        return redirect()->back()->with('error', 'Sem estoque!');
    }

    public function loja()
    {
        $produtos = Produto::all();

        return view('loja.index', compact('produtos'));
    }
}
