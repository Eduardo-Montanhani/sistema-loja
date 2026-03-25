<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios de Lucro - Sistema Loja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-gray-50 flex min-h-screen flex-col md:flex-row" x-data="{ open: false }">

    <div class="md:hidden bg-slate-900 text-white p-4 flex justify-between items-center shadow-md">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-20">
        <button @click="open = !open" class="p-2 text-2xl text-indigo-400 focus:outline-none">
            <span x-show="!open">☰</span>
            <span x-show="open">✕</span>
        </button>
    </div>

    <aside
        class="fixed inset-y-0 left-0 z-50 w-72 bg-slate-900 text-white flex flex-col shadow-2xl transition-transform duration-300 transform md:relative md:translate-x-0"
        :class="open ? 'translate-x-0' : '-translate-x-full'">

        <div class="p-8 text-center border-b border-slate-800 hidden md:block">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-32 mx-auto mb-4 drop-shadow-lg">
            <p class="text-xs uppercase tracking-widest text-slate-400 font-bold italic">Análise de Dados</p>
        </div>

        <nav class="flex-1 p-6 space-y-2 mt-4 md:mt-0">
            <a href="/dashboard" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-800 transition-colors text-slate-300">
                <span>📊</span> <span class="font-medium">Dashboard</span>
            </a>
            <a href="/produtos" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-800 transition-colors text-slate-300">
                <span>📦</span> <span class="font-medium">Produtos</span>
            </a>
            <a href="/relatorios" class="flex items-center space-x-3 p-3 rounded-lg bg-indigo-600 text-white shadow-lg shadow-indigo-900/20">
                <span>📈</span> <span class="font-medium">Relatórios</span>
            </a>
            <a href="/despesas" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-800 transition-colors text-slate-300">
                <span>💸</span> <span class="font-medium">Despesas</span>
            </a>
        </nav>

        <div class="p-6 border-t border-slate-800">
            <form method="POST" action="/logout">
                @csrf
                <button class="flex items-center space-x-3 w-full p-3 rounded-lg text-red-400 hover:bg-red-500/10 transition-colors font-semibold">
                    <span>🚪</span> <span>Sair do Sistema</span>
                </button>
            </form>
        </div>
    </aside>

    <div x-show="open" @click="open = false" class="fixed inset-0 bg-black/50 z-40 md:hidden" x-transition></div>

    <main class="flex-1 min-w-0 overflow-auto">

        @php
            $produtosVendidos = $produtos->where('quantidade_vendida', '>', 0);
            $totalLucro = 0; $totalVendas = 0; $totalCusto = 0; $totalItensVendidos = 0;

            foreach ($produtosVendidos as $p) {
                $totalVendas += $p->preco_venda * $p->quantidade_vendida;
                $totalCusto += $p->preco_compra * $p->quantidade_vendida;
                $totalLucro += ($p->preco_venda - $p->preco_compra) * $p->quantidade_vendida;
                $totalItensVendidos += $p->quantidade_vendida;
            }
            $margemMedia = $totalVendas > 0 ? ($totalLucro / $totalVendas) * 100 : 0;
        @endphp

        <header class="bg-white border-b border-gray-200 p-8">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight italic">Relatório de Lucratividade</h1>
                    <p class="text-gray-500 mt-1 font-medium">Análise detalhada de performance por item.</p>
                </div>
                <div class="hidden lg:block text-right">
                    <span class="text-[10px] font-black uppercase text-indigo-500 bg-indigo-50 px-3 py-1 rounded-full tracking-widest border border-indigo-100">Atualizado Agora</span>
                </div>
            </div>
        </header>

        <div class="p-6 md:p-8 max-w-7xl mx-auto space-y-8">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between group hover:border-indigo-200 transition-all">
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest">Itens Vendidos</p>
                    <div class="flex items-end justify-between mt-2">
                        <p class="text-3xl font-black text-slate-800">{{ $totalItensVendidos }}</p>
                        <span class="text-2xl opacity-20 group-hover:opacity-100 transition-opacity">🛍️</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between group hover:border-emerald-200 transition-all">
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest">Faturamento</p>
                    <div class="flex items-end justify-between mt-2">
                        <p class="text-3xl font-black text-emerald-600">R$ {{ number_format($totalVendas,2,',','.') }}</p>
                        <span class="text-2xl opacity-20 group-hover:opacity-100 transition-opacity">💰</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between group hover:border-blue-200 transition-all">
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest">Lucro Bruto</p>
                    <div class="flex items-end justify-between mt-2">
                        <p class="text-3xl font-black text-blue-600">R$ {{ number_format($totalLucro,2,',','.') }}</p>
                        <span class="text-2xl opacity-20 group-hover:opacity-100 transition-opacity">📈</span>
                    </div>
                </div>

                <div class="bg-indigo-600 p-6 rounded-3xl shadow-xl shadow-indigo-100 flex flex-col justify-between text-white group">
                    <p class="text-xs font-black text-indigo-200 uppercase tracking-widest">Margem Média</p>
                    <div class="flex items-end justify-between mt-2">
                        <p class="text-3xl font-black">{{ number_format($margemMedia,1) }}%</p>
                        <span class="text-2xl opacity-40 group-hover:scale-110 transition-transform">🎯</span>
                    </div>
                </div>

            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-8 py-5 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-lg font-black text-gray-800 uppercase tracking-tight">Performance por Produto</h2>
                </div>

                <div class="overflow-x-auto min-w-full">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-[11px] uppercase tracking-widest text-gray-400 font-black border-b border-gray-100">
                                <th class="px-8 py-5">Produto</th>
                                <th class="px-6 py-5 text-right">Qtd.</th>
                                <th class="px-6 py-5 text-right">Custo Unit.</th>
                                <th class="px-6 py-5 text-right">Venda Unit.</th>
                                <th class="px-6 py-5 text-right">Lucro Total</th>
                                <th class="px-8 py-5 text-right">Margem</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach ($produtosVendidos as $produto)
                                @php
                                    $lucroTotalProduto = ($produto->preco_venda - $produto->preco_compra) * $produto->quantidade_vendida;
                                    $margem = $produto->preco_compra > 0 ? (($produto->preco_venda - $produto->preco_compra) / $produto->preco_compra) * 100 : 0;
                                @endphp

                                <tr class="hover:bg-indigo-50/30 transition-colors group">
                                    <td class="px-8 py-5">
                                        <p class="font-bold text-gray-800 group-hover:text-indigo-600 transition-colors">{{ $produto->nome }}</p>
                                        <p class="text-[10px] text-gray-400 font-medium">ID: #{{ $produto->id }}</p>
                                    </td>
                                    <td class="px-6 py-5 text-right font-mono font-bold text-gray-600">
                                        {{ $produto->quantidade_vendida }}
                                    </td>
                                    <td class="px-6 py-5 text-right text-sm text-gray-500">
                                        R$ {{ number_format($produto->preco_compra,2,',','.') }}
                                    </td>
                                    <td class="px-6 py-5 text-right text-sm font-semibold text-gray-700">
                                        R$ {{ number_format($produto->preco_venda,2,',','.') }}
                                    </td>
                                    <td class="px-6 py-5 text-right">
                                        <span class="text-emerald-600 font-black text-base">
                                            R$ {{ number_format($lucroTotalProduto,2,',','.') }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-5 text-right">
                                        <span class="px-3 py-1 rounded-lg text-xs font-black {{ $margem >= 30 ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                            {{ number_format($margem,1) }}%
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($produtosVendidos->isEmpty())
                <div class="p-20 text-center">
                    <span class="text-6xl block mb-4">📭</span>
                    <p class="text-gray-400 font-bold uppercase tracking-widest">Nenhuma venda registrada ainda.</p>
                </div>
                @endif
            </div>

            <div class="flex justify-center md:justify-end no-print">
                <button onclick="window.print()" class="flex items-center gap-2 bg-slate-800 hover:bg-black text-white px-8 py-3 rounded-2xl font-black text-xs uppercase tracking-widest transition-all active:scale-95 shadow-lg">
                    <span>🖨️</span> Imprimir Relatório
                </button>
            </div>
        </div>
    </main>

</body>

</html>
