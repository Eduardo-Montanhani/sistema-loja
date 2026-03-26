<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs do Sistema - Auditoria</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 flex min-h-screen flex-col md:flex-row" x-data="{ sidebarOpen: false }">

    <aside
        class="fixed inset-y-0 left-0 z-50 w-72 bg-slate-900 text-white flex flex-col shadow-2xl transition-transform duration-300 transform md:relative md:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
        <div class="p-8 text-center border-b border-slate-800">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-32 mx-auto mb-2">
            <p class="text-[10px] uppercase tracking-widest text-slate-500 font-black">Auditoria Técnica</p>
        </div>
        <nav class="flex-1 p-6 space-y-2 mt-4">
            <a href="/dashboard" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-white transition-all">
                <span>📊</span> <span class="font-semibold">Dashboard</span>
            </a>
            <a href="/produtos" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-white transition-all">
                <span>📦</span> <span class="font-semibold">Produtos</span>
            </a>
            <a href="/logs" class="flex items-center space-x-3 p-3 rounded-xl bg-emerald-600 text-white shadow-lg shadow-emerald-900/20">
                <span>📜</span> <span class="font-semibold">Logs</span>
            </a>
        </nav>
    </aside>

    <main class="flex-1 flex flex-col min-w-0">
        <header class="bg-white border-b border-gray-200 p-6 md:p-10">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h1 class="text-4xl font-black text-gray-900 tracking-tight">Histórico de Atividades</h1>
                    <p class="text-gray-500 font-medium">Monitoramento de transações e alterações de estoque.</p>
                </div>
            </div>
        </header>

        <div class="p-4 md:p-8 max-w-7xl mx-auto w-full">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-200 overflow-hidden text-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 border-b border-gray-100">
                                <th class="px-6 py-5 text-[10px] uppercase tracking-widest text-gray-400 font-black">Usuário</th>
                                <th class="px-6 py-5 text-[10px] uppercase tracking-widest text-gray-400 font-black">Tipo</th>
                                <th class="px-6 py-5 text-[10px] uppercase tracking-widest text-gray-400 font-black text-center">Ação</th>
                                <th class="px-6 py-5 text-[10px] uppercase tracking-widest text-gray-400 font-black">Descrição</th>
                                <th class="px-6 py-5 text-[10px] uppercase tracking-widest text-gray-400 font-black text-right">Data/Hora</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($logs as $log)
                            @php
                            // Transforma em minúsculo e remove acentos para comparação
                            $textoTipo = mb_strtolower($log->tipo, 'UTF-8');
                            $textoAcao = mb_strtolower($log->acao, 'UTF-8');

                            // Funções auxiliares para busca flexível
                            $isVenda = preg_match('/vend/i', $textoTipo) || preg_match('/vend/i', $textoAcao);
                            $isProduto = preg_match('/prod/i', $textoTipo);
                            $isDespesa = preg_match('/desp/i', $textoTipo);

                            $isCriar = preg_match('/cria/i', $textoAcao);
                            $isEditar = preg_match('/edit/i', $textoAcao);
                            $isExcluir = preg_match('/exclu/i', $textoAcao) || preg_match('/apag/i', $textoAcao);
                            @endphp
                            <tr class="hover:bg-gray-50/80 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-600 font-bold text-xs uppercase">
                                            {{ substr($log->user->name ?? 'S', 0, 1) }}
                                        </div>
                                        <span class="text-gray-900 font-bold text-sm">{{ $log->user->name ?? 'Sistema' }}</span>
                                    </div>
                                </td>

                                @php
                                // Pega o tipo, se for nulo, tenta adivinhar pela descrição
                                $t = strtolower(trim($log->tipo ?? ''));
                                $d = strtolower(trim($log->descricao ?? ''));
                                $a = strtolower(trim($log->acao ?? ''));

                                // REGRAS INTELIGENTES (Se o tipo falha, ele olha a descrição)
                                $isProduto = str_contains($t, 'prod') || str_contains($d, 'prod') || str_contains($d, 'estoque');
                                $isDespesa = str_contains($t, 'desp') || str_contains($d, 'desp') || str_contains($d, 'pago') || str_contains($d, 'conta');
                                $isVenda = str_contains($t, 'vend') || str_contains($d, 'vend') || str_contains($a, 'vend');
                                @endphp

                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-[10px] font-black uppercase rounded-lg border
        @if($isProduto) bg-indigo-50 text-indigo-600 border-indigo-100
        @elseif($isDespesa) bg-pink-50 text-pink-600 border-pink-100
        @elseif($isVenda) bg-amber-50 text-amber-600 border-amber-100
        @else bg-gray-100 text-gray-700 border-gray-200
        @endif">

                                        @if($isProduto) 📦 Produto
                                        @elseif($isDespesa) 💸 Despesa
                                        @elseif($isVenda) 💰 Venda
                                        @else ❓ Indefinido
                                        @endif
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 text-[10px] font-black rounded-lg
            @if($isCriar) bg-emerald-100 text-emerald-700
            @elseif($isEditar) bg-blue-100 text-blue-700
            @elseif($isExcluir) bg-red-100 text-red-700
            @elseif($isVenda) bg-yellow-100 text-yellow-700
            @else bg-gray-100 text-gray-700
            @endif">
                                        {{ strtoupper($log->acao) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <p class="text-sm text-gray-600 font-medium">
                                        {{ $log->descricao }}
                                    </p>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <div class="text-xs font-bold text-gray-900">{{ $log->created_at->format('d/m/Y') }}</div>
                                    <div class="text-[10px] font-bold text-gray-400 uppercase italic">{{ $log->created_at->format('H:i') }}</div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-20 text-center text-gray-400 font-bold uppercase text-xs tracking-widest">
                                    Nenhum registro encontrado.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
