<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Produtos - Sistema Loja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-50 flex min-h-screen flex-col md:flex-row" x-data="{ sidebarOpen: false, modalEdit: false, modalDelete: false, activeId: null, activeName: '' }">

    <aside
        class="fixed inset-y-0 left-0 z-50 w-72 bg-slate-900 text-white flex flex-col shadow-2xl transition-transform duration-300 transform md:relative md:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
        <div class="p-8 text-center border-b border-slate-800">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-32 mx-auto mb-2">
            <p class="text-[10px] uppercase tracking-widest text-slate-500 font-black">Painel Administrativo</p>
        </div>
        <nav class="flex-1 p-6 space-y-2 mt-4">
            <a href="/dashboard" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-white transition-all">
                <span>📊</span> <span class="font-semibold">Dashboard</span>
            </a>
            <a href="/produtos" class="flex items-center space-x-3 p-3 rounded-xl bg-emerald-600 text-white shadow-lg shadow-emerald-900/20">
                <span>📦</span> <span class="font-semibold">Produtos</span>
            </a>
            <a href="/relatorios" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-white transition-all">
                <span>📈</span> <span class="font-semibold">Relatórios</span>
            </a>
        </nav>
    </aside>

    <main class="flex-1 flex flex-col min-w-0">

        <header class="bg-white border-b border-gray-200 p-6 md:p-10">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h1 class="text-4xl font-black text-gray-900 tracking-tight">Estoque Geral</h1>
                    <p class="text-gray-500 font-medium">Gerencie seus produtos e veja o que precisa de reposição.</p>
                </div>
                <a href="{{ route('produtos.create') }}" class="bg-slate-900 hover:bg-emerald-600 text-white font-black px-8 py-4 rounded-2xl shadow-xl transition-all active:scale-95 text-xs uppercase tracking-widest">
                    + Novo Produto
                </a>
            </div>
        </header>

        <div class="p-4 md:p-8 max-w-7xl mx-auto w-full">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-200 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100">
                            <th class="px-6 py-5 text-[10px] uppercase tracking-widest text-gray-400 font-black">Produto</th>
                            <th class="px-6 py-5 text-[10px] uppercase tracking-widest text-gray-400 font-black text-center">Preço</th>
                            <th class="px-6 py-5 text-[10px] uppercase tracking-widest text-gray-400 font-black text-center">Qtd</th>
                            <th class="px-6 py-5 text-[10px] uppercase tracking-widest text-gray-400 font-black text-center">Status</th>
                            <th class="px-6 py-5 text-[10px] uppercase tracking-widest text-gray-400 font-black text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach ($produtos as $produto)
                        <tr class="hover:bg-gray-50/80 transition-colors group {{ $produto->quantidade <= 0 ? 'bg-red-50/40' : '' }}">
                            <td class="px-6 py-4">
                                <span class="text-gray-900 font-bold block {{ $produto->quantidade <= 0 ? 'text-red-900' : '' }}">{{ $produto->nome }}</span>
                                <span class="text-[10px] text-gray-400 font-bold">ID #{{ $produto->id }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-black text-emerald-600 font-mono italic">R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-xl text-xs font-black {{ $produto->quantidade <= 0 ? 'bg-red-100 text-red-700 border border-red-200' : ($produto->quantidade <= 5 ? 'bg-orange-100 text-orange-600' : 'bg-emerald-50 text-emerald-700') }}">
                                    {{ $produto->quantidade }} UN
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($produto->quantidade <= 0)
                                    <span class="text-[9px] font-black uppercase text-red-600 bg-white border border-red-200 px-2 py-1 rounded shadow-sm">⚠️ ESGOTADO</span>
                                    @else
                                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-tighter">Em Estoque</span>
                                    @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <form action="{{ route('produtos.vender', $produto->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button
                                            {{ $produto->quantidade <= 0 ? 'disabled' : '' }}
                                            class="flex items-center gap-2 {{ $produto->quantidade <= 0 ? 'bg-gray-300 opacity-50 cursor-not-allowed' : 'bg-emerald-600 hover:bg-emerald-700 shadow-emerald-100 active:scale-95' }} text-white font-black px-4 py-2.5 rounded-xl text-[10px] uppercase tracking-widest transition-all shadow-md">
                                            <span>💰</span> VENDER
                                        </button>
                                    </form>

                                    <button @click="activeId = '{{ $produto->id }}'; activeName = '{{ $produto->nome }}'; modalEdit = true"
                                        class="w-10 h-10 flex items-center justify-center bg-amber-50 text-amber-600 rounded-xl hover:bg-amber-500 hover:text-white transition-all shadow-sm">
                                        ✏️
                                    </button>

                                    <button @click="activeId = '{{ $produto->id }}'; activeName = '{{ $produto->nome }}'; modalDelete = true"
                                        class="w-10 h-10 flex items-center justify-center bg-red-50 text-red-600 rounded-xl hover:bg-red-500 hover:text-white transition-all shadow-sm">
                                        🗑️
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="modalEdit" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/80 backdrop-blur-sm" x-transition>
            <div @click.away="modalEdit = false" class="bg-white rounded-3xl p-8 max-w-sm w-full shadow-2xl transform transition-all">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-4 italic">✏️</div>
                    <h3 class="text-xl font-black text-gray-900 tracking-tight">Editar Registro</h3>
                    <p class="text-xs text-gray-400 font-bold uppercase mt-2 italic" x-text="activeName"></p>
                </div>
                <form id="formEdit" :action="'/produtos/' + activeId + '/edit'" method="GET">
                    <input type="password" id="senhaInput" placeholder="SENHA MESTRE" required
                        class="w-full px-4 py-4 bg-gray-50 border-2 border-gray-100 rounded-2xl focus:border-amber-500 focus:bg-white outline-none transition-all text-center font-black placeholder:text-gray-300">

                    <div class="grid grid-cols-2 gap-3 mt-6">
                        <button type="button" @click="modalEdit = false" class="py-4 text-[10px] font-black text-gray-400 hover:text-gray-600 uppercase tracking-widest">Voltar</button>
                        <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-black py-4 rounded-2xl shadow-lg shadow-amber-100 uppercase text-[10px] tracking-widest transition-all active:scale-95">Editar</button>
                    </div>
                </form>
            </div>
        </div>

        <div x-show="modalDelete" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/80 backdrop-blur-sm" x-transition>
            <div @click.away="modalDelete = false" class="bg-white rounded-3xl p-8 max-w-sm w-full shadow-2xl border-b-8 border-red-600">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-4">🗑️</div>
                    <h3 class="text-xl font-black text-gray-900 tracking-tight">Apagar Produto?</h3>
                    <p class="text-xs text-red-500 font-bold mt-2">Esta ação é irreversível!</p>
                </div>
                <form :action="'/produtos/' + activeId" method="POST">
                    @csrf @method('DELETE')
                    <input type="password" name="master_password" placeholder="SENHA DE SEGURANÇA" required
                        class="w-full px-4 py-4 bg-gray-50 border-2 border-gray-100 rounded-2xl focus:border-red-500 focus:bg-white outline-none transition-all text-center font-black placeholder:text-gray-300">
                    <div class="grid grid-cols-2 gap-3 mt-6">
                        <button type="button" @click="modalDelete = false" class="py-4 text-[10px] font-black text-gray-400 hover:text-gray-600 uppercase tracking-widest">Sair</button>
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-black py-4 rounded-2xl shadow-lg shadow-red-200 uppercase text-[10px] tracking-widest transition-all active:scale-95">Apagar</button>
                    </div>
                </form>
            </div>
        </div>

    </main>
</body>

</html>
<script>
    document.getElementById('formEdit').addEventListener('submit', function(e) {
        e.preventDefault();

        const senha = document.getElementById('senhaInput').value;
        const action = this.action;

        fetch(action, {
                method: 'GET',
                headers: {
                    'X-MASTER-PASSWORD': senha
                }
            })
            .then(response => {
                if (response.redirected) {
                    window.location.href = response.url;
                } else {
                    return response.text().then(html => {
                        document.open();
                        document.write(html);
                        document.close();
                    });
                }
            });
    });
</script>
