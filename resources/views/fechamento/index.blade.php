<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fechamento Mensal - Sistema Loja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        @media print { .no-print { display: none; } }
    </style>
</head>

<body class="bg-gray-50 flex min-h-screen">

    <aside class="w-72 bg-slate-900 text-white flex flex-col shadow-2xl no-print">
        <div class="p-8 text-center border-b border-slate-800">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-32 mx-auto mb-4 drop-shadow-lg">
            <p class="text-xs uppercase tracking-widest text-slate-400 font-bold">Relatórios Finais</p>
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
            <a href="/despesas" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-800 transition-colors text-slate-300">
                <span>💸</span> <span class="font-medium">Despesas</span>
            </a>
        </nav>
    </aside>

    <main class="flex-1 flex flex-col">

        <header class="bg-white border-b border-gray-200 p-8 no-print">
            <div class="max-w-5xl mx-auto flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">📄 Fechamento Mensal</h1>
                    <p class="text-gray-500 mt-1">Resumo financeiro consolidado do período.</p>
                </div>

                <a href="{{ route('fechamento.pdf') }}"
                    class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-6 py-3 rounded-xl shadow-lg shadow-indigo-100 transition-all active:scale-95">
                    <span class="mr-2">📥</span> Gerar PDF
                </a>
            </div>
        </header>

        <div class="p-8 max-w-5xl mx-auto w-full space-y-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 bg-emerald-50 border-b border-emerald-100 flex justify-between items-center">
                        <h2 class="text-lg font-bold text-emerald-800">💰 Vendas</h2>
                        <span class="text-xs font-black text-emerald-600 uppercase tracking-widest">Entradas</span>
                    </div>
                    <div class="p-6 space-y-3 max-h-96 overflow-y-auto">
                        @foreach($vendas as $v)
                        <div class="flex justify-between items-center text-sm border-b border-gray-50 pb-2">
                            <span class="text-gray-600">{{ $v->nome }}</span>
                            <span class="font-bold text-gray-900">R$ {{ number_format($v->preco_venda,2,',','.') }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 bg-red-50 border-b border-red-100 flex justify-between items-center">
                        <h2 class="text-lg font-bold text-red-800">💸 Despesas</h2>
                        <span class="text-xs font-black text-red-600 uppercase tracking-widest">Saídas</span>
                    </div>
                    <div class="p-6 space-y-3 max-h-96 overflow-y-auto">
                        @foreach($despesas as $d)
                        <div class="flex justify-between items-center text-sm border-b border-gray-50 pb-2">
                            <span class="text-gray-600">{{ $d->nome }}</span>
                            <span class="font-bold text-red-600">- R$ {{ number_format($d->valor,2,',','.') }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <div class="bg-slate-900 rounded-3xl p-8 shadow-2xl text-white relative overflow-hidden">
                <div class="absolute right-0 top-0 p-8 opacity-10">
                    <span class="text-9xl">📊</span>
                </div>

                <h2 class="text-xl font-bold mb-6 flex items-center gap-2">
                    <span class="w-2 h-2 bg-indigo-500 rounded-full"></span>
                    Resumo do Balanço
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="border-l border-slate-700 pl-6">
                        <p class="text-slate-400 text-sm font-medium uppercase tracking-widest">Total Vendas</p>
                        <p class="text-2xl font-bold mt-1 text-emerald-400">R$ {{ number_format($totalVendas,2,',','.') }}</p>
                    </div>

                    <div class="border-l border-slate-700 pl-6">
                        <p class="text-slate-400 text-sm font-medium uppercase tracking-widest">Total Despesas</p>
                        <p class="text-2xl font-bold mt-1 text-red-400">R$ {{ number_format($totalDespesas,2,',','.') }}</p>
                    </div>

                    <div class="bg-white/10 rounded-2xl p-6 backdrop-blur-md">
                        <p class="text-indigo-200 text-sm font-bold uppercase tracking-widest">Lucro Líquido</p>
                        <p class="text-4xl font-black mt-2 {{ $lucro >= 0 ? 'text-emerald-400' : 'text-red-400' }}">
                            R$ {{ number_format($lucro,2,',','.') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="text-center text-gray-400 text-xs py-4 no-print">
                Relatório gerado em {{ date('d/m/Y H:i') }}
            </div>

        </div>
    </main>

</body>
</html>
