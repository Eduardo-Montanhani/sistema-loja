<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        $request->validate([
            'nome' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'data' => 'required|date',
        ]);

        $data = Carbon::parse($request->data);
        $hoje = Carbon::today();

        // ❌ futuro
        if ($data->gt($hoje)) {
            return back()->withErrors([
                'data' => 'A data não pode ser maior que hoje.'
            ])->withInput();
        }

        // ❌ mês diferente
        if ($data->month !== $hoje->month || $data->year !== $hoje->year) {
            return back()->withErrors([
                'data' => 'A despesa deve ser do mês atual.'
            ])->withInput();
        }

        Despesa::create($request->all());

        return redirect()->route('despesas.index');
    }



    public function destroy(Request $request, $id)
    {
        // 🔐 valida senha do usuário logado
        if (!Hash::check($request->master_password, Auth::user()->password)) {
            return redirect()->back()->with('erro', 'Senha incorreta!');
        }

        $despesa = Despesa::findOrFail($id);
        $despesa->delete();

        return redirect()->route('despesas.index')
            ->with('success', 'Despesa excluída com sucesso!');
    }
}
