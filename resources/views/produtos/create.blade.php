<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto - Sistema Loja</title>
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
        <button @click="open = !open" class="p-2 text-2xl text-emerald-500 focus:outline-none">
            <span x-show="!open">☰</span>
            <span x-show="open">✕</span>
        </button>
    </div>

    <aside
        class="fixed inset-y-0 left-0 z-50 w-72 bg-slate-900 text-white flex flex-col shadow-2xl transition-transform duration-300 transform md:relative md:translate-x-0"
        :class="open ? 'translate-x-0' : '-translate-x-full'">

        <div class="p-8 text-center border-b border-slate-800 hidden md:block">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-32 mx-auto mb-4 drop-shadow-lg">
            <p class="text-xs uppercase tracking-widest text-slate-400 font-bold">Novo Item</p>
        </div>

        <nav class="flex-1 p-6 space-y-2 mt-4 md:mt-0">
            <a href="/dashboard" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-800 transition-colors text-slate-300">
                <span>📊</span> <span class="font-medium">Dashboard</span>
            </a>
            <a href="/produtos" class="flex items-center space-x-3 p-3 rounded-lg bg-emerald-600 text-white shadow-lg shadow-emerald-900/20">
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
                    <span>🚪</span> <span>Sair</span>
                </button>
            </form>
        </div>
    </aside>

    <div x-show="open" @click="open = false" class="fixed inset-0 bg-black/50 z-40 md:hidden" x-transition></div>

    <main class="flex-1 flex flex-col min-w-0">

        <header class="bg-white border-b border-gray-200 p-6 md:p-8">
            <div class="max-w-3xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="text-center md:text-left">
                    <a href="/produtos" class="text-emerald-600 hover:text-emerald-800 text-xs font-black flex items-center justify-center md:justify-start gap-1 mb-2">
                        <span>←</span> CANCELAR E VOLTAR
                    </a>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
                        Cadastrar Novo Produto
                    </h1>
                </div>
                <div class="bg-emerald-100 text-emerald-700 px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border border-emerald-200">
                    Novo Registro
                </div>
            </div>
        </header>

        <div class="p-4 md:p-8 flex justify-center">

            <div class="bg-white rounded-3xl shadow-sm border border-gray-200 w-full max-w-2xl overflow-hidden transition-all hover:shadow-md">

                <div class="p-6 md:p-10">
                    <form method="POST" action="/produtos" class="space-y-6">
                        @csrf

                        <div class="group">
                            <label class="block text-xs font-black text-gray-400 uppercase mb-2 tracking-widest group-focus-within:text-emerald-600 transition-colors">
                                Nome do Produto
                            </label>
                            <input
                                type="text"
                                name="nome"
                                placeholder="Ex: Cadeira Gamer RGB"
                                class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 focus:ring-0 focus:border-emerald-500 focus:bg-white outline-none transition-all font-medium text-gray-700"
                                required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="group">
                                <label class="block text-xs font-black text-gray-400 uppercase mb-2 tracking-widest group-focus-within:text-blue-500 transition-colors">
                                    Preço de Compra (Custo)
                                </label>
                                <div class="relative">
                                    <span class="absolute left-4 top-4 text-gray-400 font-bold italic">R$</span>
                                    <input
                                        type="number"
                                        step="0.01"
                                        name="preco_compra"
                                        placeholder="0,00"
                                        class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 pl-12 focus:border-blue-500 focus:bg-white outline-none transition-all font-bold text-gray-600"
                                        required>
                                </div>
                            </div>

                            <div class="group">
                                <label class="block text-xs font-black text-gray-400 uppercase mb-2 tracking-widest group-focus-within:text-emerald-500 transition-colors">
                                    Preço de Venda (Lucro)
                                </label>
                                <div class="relative">
                                    <span class="absolute left-4 top-4 text-emerald-500 font-bold italic">R$</span>
                                    <input
                                        type="number"
                                        step="0.01"
                                        name="preco_venda"
                                        placeholder="0,00"
                                        class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 pl-12 focus:border-emerald-500 focus:bg-white outline-none transition-all font-bold text-emerald-700"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="max-w-xs group">
                            <label class="block text-xs font-black text-gray-400 uppercase mb-2 tracking-widest group-focus-within:text-emerald-600 transition-colors">
                                Quantidade Inicial
                            </label>
                            <div class="flex items-center gap-3">
                                <input
                                    type="number"
                                    name="quantidade"
                                    placeholder="0"
                                    class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 focus:border-emerald-500 focus:bg-white outline-none transition-all font-mono text-xl text-center"
                                    required>
                                <span class="text-xs font-bold text-gray-400 uppercase">Unid.</span>
                            </div>
                        </div>

                        <div class="pt-8 border-t border-gray-50 flex flex-col md:flex-row items-center justify-between gap-6">
                            <button
                                type="submit"
                                class="w-full md:w-auto bg-emerald-600 hover:bg-emerald-700 text-white font-black px-10 py-4 rounded-2xl shadow-xl shadow-emerald-100 transition-all active:scale-95 flex items-center justify-center gap-3">
                                <span>➕</span> CADASTRAR PRODUTO
                            </button>

                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest text-center md:text-left">
                                Preencha todos os campos <br> para habilitar o registro.
                            </p>
                        </div>
                    </form>
                </div>

                <div class="bg-emerald-50/50 p-6 border-t border-emerald-100 flex items-center gap-4">
                    <div class="bg-white p-2 rounded-lg shadow-sm">💡</div>
                    <p class="text-[11px] text-emerald-700 font-medium leading-relaxed">
                        **Dica:** O preço de venda deve ser superior ao preço de compra para que o sistema calcule seu lucro corretamente nos relatórios.
                    </p>
                </div>

            </div>

        </div>
    </main>

</body>
</html>
