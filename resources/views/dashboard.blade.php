<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema Loja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 flex min-h-screen">

    <aside class="w-72 bg-slate-900 text-white flex flex-col shadow-2xl transition-all">
        <div class="p-8 text-center border-b border-slate-800">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-32 mx-auto mb-4 drop-shadow-lg">
            <p class="text-xs uppercase tracking-widest text-slate-400 font-bold">Painel de Controle</p>
        </div>

        <nav class="flex-1 p-6 space-y-2">
            <a href="/dashboard" class="flex items-center space-x-3 p-3 rounded-lg bg-indigo-600 text-white shadow-lg shadow-indigo-900/20">
                <span class="text-lg">📊</span>
                <span class="font-medium">Dashboard</span>
            </a>

            <a href="/produtos" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-800 transition-colors text-slate-300 hover:text-white">
                <span class="text-lg">📦</span>
                <span class="font-medium">Produtos</span>
            </a>

            <a href="/relatorios" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-800 transition-colors text-slate-300 hover:text-white">
                <span class="text-lg">📈</span>
                <span class="font-medium">Relatórios</span>
            </a>

            <a href="/despesas" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-800 transition-colors text-slate-300 hover:text-white">
                <span>💸</span> <span class="font-medium">Despesas</span>
            </a>

            <a href="/fechamento" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-800 transition-colors text-slate-300 hover:text-white">
                📄 Fechamento Mensal
            </a>
            <a href="/logs" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-800 transition-colors text-slate-300 hover:text-white">
                📄 Log
            </a>
            <a href="/loja" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-800 transition-colors text-slate-300 hover:text-white">
                @Loja
            </a>
        </nav>

        <div class="p-6 border-t border-slate-800">
            <form method="POST" action="/logout">
                @csrf
                <button class="flex items-center space-x-3 w-full p-3 rounded-lg text-red-400 hover:bg-red-500/10 transition-colors font-semibold text-left">
                    <span>🚪</span>
                    <span>Sair do Sistema</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col">
        @if(session('erro'))
        <div id="modalErro" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
            <div class="bg-white rounded-2xl p-8 shadow-xl text-center max-w-sm w-full">
                <h2 class="text-xl font-bold text-red-600 mb-4">🚫 Acesso negado</h2>
                <p class="text-gray-600 mb-6">
                    Você não tem permissão para acessar esta página.
                </p>

                <button onclick="document.getElementById('modalErro').remove()"
                    class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg font-bold">
                    Fechar
                </button>
            </div>
        </div>
        @endif

        <header class="bg-white border-b border-gray-200 p-8">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Visão Geral</h1>
                    <p class="text-gray-500 mt-1">Bem-vindo ao resumo da sua loja hoje.</p>
                </div>
                <div class="hidden md:block text-right">
                    <p class="text-sm font-medium text-gray-400 uppercase tracking-wider">Data de hoje</p>
                    <p class="font-bold text-gray-700">{{ date('d/m/Y') }}</p>
                </div>
            </div>
        </header>

        <div class="p-8 max-w-7xl mx-auto w-full space-y-10">
            <div class="grid grid-cols-3 gap-6 mb-8">

                <!-- LUCRO VENDAS -->
                <div class="bg-white p-5 rounded shadow">
                    <p class="text-gray-500">Lucro com Vendas</p>
                    <p class="text-2xl font-bold text-green-600">
                        R$ {{ number_format($lucroTotal,2,',','.') }}
                    </p>
                </div>

                <!-- DESPESAS -->
                <div class="bg-white p-5 rounded shadow">
                    <p class="text-gray-500">Despesas</p>
                    <p class="text-2xl font-bold text-red-500">
                        R$ {{ number_format($totalDespesas,2,',','.') }}
                    </p>
                </div>

                <!-- LUCRO REAL -->
                <div class="bg-white p-5 rounded shadow">
                    <p class="text-gray-500">Lucro Real</p>
                    <p class="text-2xl font-bold
            {{ $lucroReal >= 0 ? 'text-blue-600' : 'text-red-600' }}">

                        R$ {{ number_format($lucroReal,2,',','.') }}
                    </p>
                </div>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition-shadow">
                    <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <span class="text-6xl text-indigo-600">📦</span>
                    </div>
                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Total de Itens</p>
                    <h2 class="text-4xl font-black text-slate-800 mt-2">{{ $totalProdutos }}</h2>
                    <p class="text-xs text-indigo-600 mt-4 font-bold tracking-wide">EM ESTOQUE AGORA</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition-shadow">
                    <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <span class="text-6xl text-emerald-600">💰</span>
                    </div>
                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Capital Investido</p>
                    <h2 class="text-4xl font-black text-emerald-600 mt-2">R$ {{ number_format($valorEstoque,2,',','.') }}</h2>
                    <p class="text-xs text-emerald-600 mt-4 font-bold tracking-wide">VALOR TOTAL DE COMPRA</p>
                </div>

                <div class="bg-gradient-to-br from-indigo-600 to-indigo-700 p-8 rounded-2xl shadow-xl shadow-indigo-100 flex flex-col justify-between">
                    <div>
                        <p class="text-sm font-bold text-indigo-100 uppercase tracking-wider">Ações Rápidas</p>
                        <h2 class="text-xl font-bold text-white mt-1">Gerenciar Inventário</h2>
                    </div>
                    <a href="/produtos" class="mt-4 bg-white/10 hover:bg-white/20 text-white border border-white/20 text-center py-3 rounded-xl font-bold transition-all backdrop-blur-sm">
                        Ir para lista de produtos →
                    </a>
                </div>

            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-8 py-5 bg-gray-50/50 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-extrabold text-gray-800">
                        Últimos Cadastros
                    </h2>
                    <span class="text-xs font-bold text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full uppercase">Recentes</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-xs uppercase tracking-wider text-gray-400 font-bold border-b border-gray-100">
                                <th class="px-8 py-4">Nome do Produto</th>
                                <th class="px-8 py-4">Preço Compra</th>
                                <th class="px-8 py-4">Preço Venda</th>
                                <th class="px-8 py-4 text-center">Quantidade</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach ($produtos as $produto)
                            <tr class="hover:bg-gray-50/80 transition-colors">
                                <td class="px-8 py-4 font-semibold text-gray-700">{{ $produto->nome }}</td>
                                <td class="px-8 py-4 text-gray-500 text-sm">R$ {{ number_format($produto->preco_compra,2,',','.') }}</td>
                                <td class="px-8 py-4 font-bold text-emerald-600">R$ {{ number_format($produto->preco_venda,2,',','.') }}</td>
                                <td class="px-8 py-4 text-center">
                                    <span class="px-3 py-1 bg-gray-100 rounded-lg text-xs font-bold text-gray-600">
                                        {{ $produto->quantidade }} un.
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="bg-gray-50 p-4 text-center border-t border-gray-100">
                    <a href="/produtos" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 transition-colors uppercase tracking-widest">
                        Ver todo o estoque
                    </a>
                </div>
            </div>

        </div>
    </main>

</body>

</html>
