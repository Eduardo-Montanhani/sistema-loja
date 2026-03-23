<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios de Lucro - Sistema Loja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
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
                <span class="text-lg">📊</span>
                <span class="font-medium">Dashboard</span>
            </a>
            <a href="/produtos" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-800 transition-colors text-slate-300">
                <span class="text-lg">📦</span>
                <span class="font-medium">Produtos</span>
            </a>
            <a href="/relatorios" class="flex items-center space-x-3 p-3 rounded-lg bg-indigo-600 text-white shadow-lg shadow-indigo-900/20">
                <span class="text-lg">📈</span>
                <span class="font-medium">Relatórios</span>
            </a>
        </nav>

        <div class="p-6 border-t border-slate-800">
            <form method="POST" action="/logout">
                @csrf
                <button class="flex items-center space-x-3 w-full p-3 rounded-lg text-red-400 hover:bg-red-500/10 transition-colors font-semibold">
                    <span>🚪</span>
                    <span>Sair</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col">

        <header class="bg-white border-b border-gray-200 p-8">
            <div class="max-w-7xl mx-auto">
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Relatório de Lucratividade</h1>
                <p class="text-gray-500 mt-1">Análise detalhada de performance de vendas e margens.</p>
            </div>
        </header>

        <div class="p-8 max-w-7xl mx-auto w-full space-y-8">

            @php
                $produtosVendidos = $produtos->where('vendido', true);
                $totalLucro = 0;
                $totalVendas = 0;
                $totalCusto = 0;

                foreach ($produtosVendidos as $p) {
                    $totalVendas += $p->preco_venda;
                    $totalCusto += $p->preco_compra;
                    $totalLucro += ($p->preco_venda - $p->preco_compra);
                }

                $margemMedia = $totalVendas > 0 ? ($totalLucro / $totalVendas) * 100 : 0;
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Produtos Vendidos</p>
                    <p class="text-3xl font-black text-slate-800 mt-2">{{ $produtosVendidos->count() }}</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <p class="text-sm font-bold text-emerald-500 uppercase tracking-wider">Total em Vendas</p>
                    <p class="text-3xl font-black text-emerald-600 mt-2">R$ {{ number_format($totalVendas, 2, ',', '.') }}</p>
                </div>

                <div class="bg-indigo-600 p-6 rounded-2xl shadow-xl shadow-indigo-100">
                    <p class="text-sm font-bold text-indigo-100 uppercase tracking-wider">Lucro Líquido</p>
                    <p class="text-3xl font-black text-white mt-2">R$ {{ number_format($totalLucro, 2, ',', '.') }}</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <p class="text-sm font-bold text-blue-500 uppercase tracking-wider">Margem Média</p>
                    <p class="text-3xl font-black text-blue-600 mt-2">{{ number_format($margemMedia, 1) }}%</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="font-bold text-gray-700">Detalhamento por Item</h3>
                </div>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-xs uppercase tracking-wider text-gray-500 font-bold">
                            <th class="px-6 py-4">Produto</th>
                            <th class="px-6 py-4 text-right">Custo</th>
                            <th class="px-6 py-4 text-right">Venda</th>
                            <th class="px-6 py-4 text-right text-indigo-600">Lucro</th>
                            <th class="px-6 py-4 text-right">Margem</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($produtosVendidos as $produto)
                        @php
                            $lucro = $produto->preco_venda - $produto->preco_compra;
                            $perc = ($produto->preco_compra > 0) ? ($lucro / $produto->preco_compra) * 100 : 0;
                        @endphp
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="text-gray-900 font-semibold">{{ $produto->nome }}</span>
                            </td>
                            <td class="px-6 py-4 text-right text-gray-500">
                                R$ {{ number_format($produto->preco_compra, 2, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-right text-gray-900 font-medium">
                                R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-emerald-600">
                                R$ {{ number_format($lucro, 2, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold {{ $perc > 30 ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                                    {{ number_format($perc, 1) }}%
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>
