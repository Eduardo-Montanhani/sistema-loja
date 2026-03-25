<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto - Sistema Loja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-gray-50 flex min-h-screen flex-col md:flex-row" x-data="{ open: false }">

    <div class="md:hidden bg-slate-900 text-white p-4 flex justify-between items-center shadow-md">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-20">
        <button @click="open = !open" class="p-2 text-2xl text-amber-500 focus:outline-none">
            <span x-show="!open">☰</span>
            <span x-show="open">✕</span>
        </button>
    </div>

    <aside
        class="fixed inset-y-0 left-0 z-50 w-72 bg-slate-900 text-white flex flex-col shadow-2xl transition-transform duration-300 transform md:relative md:translate-x-0"
        :class="open ? 'translate-x-0' : '-translate-x-full'">

        <div class="p-8 text-center border-b border-slate-800 hidden md:block">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-32 mx-auto mb-4 drop-shadow-lg">
            <p class="text-xs uppercase tracking-widest text-slate-400 font-bold">Gerenciamento</p>
        </div>

        <nav class="flex-1 p-6 space-y-2 mt-4 md:mt-0">
            <a href="/dashboard" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-800 transition-colors text-slate-300">
                <span>📊</span> <span class="font-medium">Dashboard</span>
            </a>
            <a href="/produtos" class="flex items-center space-x-3 p-3 rounded-lg bg-indigo-600 text-white shadow-lg shadow-indigo-900/20">
                <span>📦</span> <span class="font-medium">Produtos</span>
            </a>
            <a href="/relatorios" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-800 transition-colors text-slate-300">
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

    <main class="flex-1 flex flex-col min-w-0">

        <header class="bg-white border-b border-gray-200 p-6 md:p-8">
            <div class="max-w-3xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="text-center md:text-left">
                    <a href="/produtos" class="text-indigo-600 hover:text-indigo-800 text-xs font-black flex items-center justify-center md:justify-start gap-1 mb-2">
                        <span>←</span> VOLTAR PARA LISTA
                    </a>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight italic">
                        Editar Produto
                    </h1>
                </div>
                <div class="bg-amber-100 text-amber-700 px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border border-amber-200">
                    Modo de Edição
                </div>
            </div>
        </header>

        <div class="p-4 md:p-8 flex justify-center">

            <div class="bg-white rounded-3xl shadow-sm border border-gray-200 w-full max-w-2xl overflow-hidden transition-all hover:shadow-md">

                <div class="p-6 md:p-10">
                    <form method="POST" action="{{ route('produtos.update', $produto->id) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="group">
                            <label class="block text-xs font-black text-gray-400 uppercase mb-2 tracking-widest transition-colors group-focus-within:text-indigo-600">
                                Nome do Produto
                            </label>
                            <input
                                type="text"
                                name="nome"
                                value="{{ $produto->nome }}"
                                class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 focus:ring-0 focus:border-indigo-500 focus:bg-white outline-none transition-all font-medium text-gray-700"
                                required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="group">
                                <label class="block text-xs font-black text-gray-400 uppercase mb-2 tracking-widest transition-colors group-focus-within:text-indigo-600">
                                    Preço de Compra
                                </label>
                                <div class="relative">
                                    <span class="absolute left-4 top-4 text-gray-400 font-bold italic">R$</span>
                                    <input
                                        type="number"
                                        step="0.01"
                                        name="preco_compra"
                                        value="{{ $produto->preco_compra }}"
                                        class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 pl-12 focus:border-indigo-500 focus:bg-white outline-none transition-all font-bold"
                                        required>
                                </div>
                            </div>

                            <div class="group">
                                <label class="block text-xs font-black text-gray-400 uppercase mb-2 tracking-widest transition-colors group-focus-within:text-emerald-500">
                                    Preço de Venda
                                </label>
                                <div class="relative">
                                    <span class="absolute left-4 top-4 text-emerald-500 font-bold italic">R$</span>
                                    <input
                                        type="number"
                                        step="0.01"
                                        name="preco_venda"
                                        value="{{ $produto->preco_venda }}"
                                        class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 pl-12 focus:border-emerald-500 focus:bg-white outline-none transition-all font-bold text-emerald-600"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="max-w-xs group">
                            <label class="block text-xs font-black text-gray-400 uppercase mb-2 tracking-widest transition-colors group-focus-within:text-indigo-600">
                                Quantidade em Estoque
                            </label>
                            <input
                                type="number"
                                name="quantidade"
                                value="{{ $produto->quantidade }}"
                                class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 focus:border-indigo-500 focus:bg-white outline-none transition-all font-mono text-xl text-center"
                                required>
                        </div>

                        <div class="pt-6 border-t border-gray-50 flex flex-col md:flex-row items-center justify-between gap-6">
                            <button
                                type="submit"
                                class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-black px-10 py-4 rounded-2xl shadow-xl shadow-indigo-100 transition-all active:scale-95 flex items-center justify-center gap-3">
                                <span>💾</span> ATUALIZAR AGORA
                            </button>

                            <a href="/produtos" class="text-gray-400 hover:text-red-500 text-xs font-black uppercase tracking-widest transition-colors">
                                Cancelar Alterações
                            </a>
                        </div>
                    </form>
                </div>

                <div class="bg-gray-50/50 p-6 flex justify-between items-center border-t border-gray-100">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">SKU Interno: #{{ str_pad($produto->id, 5, '0', STR_PAD_LEFT) }}</span>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">Status: Ativo no Sistema</span>
                </div>

            </div>

        </div>
    </main>

</body>
</html>
