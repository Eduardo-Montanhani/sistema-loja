<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Despesas - Sistema Loja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 flex min-h-screen">

    <aside class="w-72 bg-slate-900 text-white flex flex-col shadow-2xl">
        <div class="p-8 text-center border-b border-slate-800">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-32 mx-auto mb-4 drop-shadow-lg">
            <p class="text-xs uppercase tracking-widest text-slate-400 font-bold">Painel Administrativo</p>
        </div>

        <nav class="flex-1 p-6 space-y-2">
            <a href="/dashboard" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-800 transition-colors text-slate-300">
                <span>📊</span> <span class="font-medium">Dashboard</span>
            </a>
            <a href="/produtos" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-800 transition-colors text-slate-300">
                <span>📦</span> <span class="font-medium">Produtos</span>
            </a>
            <a href="/relatorios" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-800 transition-colors text-slate-300">
                <span>📈</span> <span class="font-medium">Relatórios</span>
            </a>
            <a href="/despesas" class="flex items-center space-x-3 p-3 rounded-lg bg-amber-600 text-white shadow-lg shadow-amber-900/20">
                <span>💸</span> <span class="font-medium">Despesas</span>
            </a>
        </nav>

        <div class="p-6 border-t border-slate-800">
            <form method="POST" action="/logout">
                @csrf
                <button class="flex items-center space-x-3 w-full p-3 rounded-lg text-red-400 hover:bg-red-500/10 transition-colors font-semibold">
                    <span>🚪</span> <span>Sair</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col">

        <header class="bg-white border-b border-gray-200 p-8">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Despesas</h1>
                    <p class="text-gray-500 mt-1">Controle de custos e saídas de caixa.</p>
                </div>

                <a href="{{ route('despesas.create') }}"
                    class="inline-flex items-center justify-center bg-amber-500 hover:bg-amber-600 text-white font-bold px-6 py-3 rounded-xl shadow-lg shadow-amber-100 transition-all active:scale-95">
                    <span class="mr-2">💸</span> Nova Despesa
                </a>
            </div>
        </header>

        <div class="p-8 max-w-7xl mx-auto w-full space-y-6">

            @if(session('erro'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm mb-4 flex items-center">
                <span class="mr-2">⚠️</span> {{ session('erro') }}
            </div>
            @endif

            @if(session('success'))
            <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-lg shadow-sm mb-4 flex items-center">
                <span class="mr-2">✅</span> {{ session('success') }}
            </div>
            @endif

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
                <div>
                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Total de Gastos (Mês)</p>
                    @php $total = $despesas->sum('valor'); @endphp
                    <h2 class="text-3xl font-black text-red-600 mt-1">
                        R$ {{ number_format($total,2,',','.') }}
                    </h2>
                </div>
                <div class="text-5xl opacity-20">🧾</div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th class="px-6 py-4 text-xs uppercase tracking-wider text-gray-500 font-bold">Descrição</th>
                                <th class="px-6 py-4 text-xs uppercase tracking-wider text-gray-500 font-bold text-center">Data</th>
                                <th class="px-6 py-4 text-xs uppercase tracking-wider text-gray-500 font-bold text-right">Valor</th>
                                <th class="px-6 py-4 text-xs uppercase tracking-wider text-gray-500 font-bold text-right">Ações</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @foreach($despesas as $despesa)
                            <tr class="hover:bg-amber-50/30 transition-colors group">
                                <td class="px-6 py-4">
                                    <span class="text-gray-900 font-semibold block">{{ $despesa->nome }}</span>
                                </td>

                                <td class="px-6 py-4 text-center text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($despesa->data)->format('d/m/Y') }}
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <span class="text-red-600 font-bold">
                                        - R$ {{ number_format($despesa->valor,2,',','.') }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <form action="{{ route('despesas.destroy', $despesa->id) }}" method="POST" class="flex items-center justify-end gap-2">
                                        @csrf
                                        @method('DELETE')
                                        <input
                                            type="password"
                                            name="master_password"
                                            placeholder="Senha"
                                            required
                                            class="w-24 border border-gray-200 px-3 py-1.5 rounded-lg text-xs focus:ring-2 focus:ring-red-500 focus:border-transparent outline-none transition-all">
                                        <button class="bg-red-500 hover:bg-red-600 text-white text-xs font-bold px-3 py-1.5 rounded-lg transition-colors shadow-sm shadow-red-100">
                                            Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($despesas->isEmpty())
                <div class="p-20 text-center">
                    <p class="text-gray-400 text-lg italic">Nenhuma despesa registrada.</p>
                </div>
                @endif
            </div>

            <div class="text-center text-sm text-gray-400">
                Mostrando {{ $despesas->count() }} registros de saída.
            </div>
        </div>
    </main>

</body>

</html>
