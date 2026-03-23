<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Produtos - Sistema Loja</title>
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
            <a href="/dashboard" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-800 transition-colors text-slate-300 hover:text-white">
                <span class="text-lg">📊</span>
                <span class="font-medium">Dashboard</span>
            </a>

            <a href="/produtos" class="flex items-center space-x-3 p-3 rounded-lg bg-blue-600 text-white shadow-lg shadow-blue-900/20">
                <span class="text-lg">📦</span>
                <span class="font-medium">Produtos</span>
            </a>
        </nav>

        <div class="p-6 border-t border-slate-800">
            <form method="POST" action="/logout">
                @csrf
                <button class="flex items-center space-x-3 w-full p-3 rounded-lg text-red-400 hover:bg-red-500/10 transition-colors font-semibold">
                    <span>🚪</span>
                    <span>Sair do Sistema</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col">

        <header class="bg-white border-b border-gray-200 p-8">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <a href="/dashboard" class="text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center mb-2">
                        ← Voltar ao início
                    </a>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Lista de Produtos</h1>
                </div>

                <a href="{{ route('produtos.create') }}"
                    class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-6 py-3 rounded-xl shadow-lg shadow-indigo-100 transition-all active:scale-95">
                    <span class="mr-2">+</span> Novo Produto
                </a>
            </div>
        </header>

        <div class="p-8 max-w-7xl mx-auto w-full">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-4 text-xs uppercase tracking-wider text-gray-500 font-bold">ID</th>
                            <th class="px-6 py-4 text-xs uppercase tracking-wider text-gray-500 font-bold">Produto</th>
                            <th class="px-6 py-4 text-xs uppercase tracking-wider text-gray-500 font-bold text-center">Valores</th>
                            <th class="px-6 py-4 text-xs uppercase tracking-wider text-gray-500 font-bold text-center">Estoque</th>
                            <th class="px-6 py-4 text-xs uppercase tracking-wider text-gray-500 font-bold text-center">Status</th>
                            <th class="px-6 py-4 text-xs uppercase tracking-wider text-gray-500 font-bold text-right">Gerenciar</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @foreach ($produtos as $produto)
                        <tr class="hover:bg-blue-50/30 transition-colors group">
                            <td class="px-6 py-4 text-sm text-gray-400 font-mono">#{{ $produto->id }}</td>

                            <td class="px-6 py-4">
                                <span class="text-gray-900 font-semibold block">{{ $produto->nome }}</span>
                                <span class="text-xs text-gray-400">Ref: PROD-{{ $produto->id }}</span>
                            </td>

                            <td class="px-6 py-4 text-center">
                                <div class="text-xs text-gray-400 line-through">C: R$ {{ number_format($produto->preco_compra,2,',','.') }}</div>
                                <div class="text-sm font-bold text-emerald-600">V: R$ {{ number_format($produto->preco_venda,2,',','.') }}</div>
                            </td>

                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                    {{ $produto->quantidade }} un.
                                </span>
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if($produto->vendido)
                                <span class="px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider bg-red-100 text-red-600 border border-red-200">
                                    Esgotado
                                </span>
                                @else
                                <span class="px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider bg-emerald-100 text-emerald-600 border border-emerald-200">
                                    Disponível
                                </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-right space-x-2">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('produtos.edit', $produto->id) }}"
                                        class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Editar">
                                        ✏️
                                    </a>

                                    <form action="{{ route('produtos.vender', $produto->id) }}" method="POST" class="inline">
                                        @csrf @method('PATCH')
                                        <button class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors" title="Marcar como Vendido">
                                            💰
                                        </button>
                                    </form>

                                    <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" class="inline group/del">
                                        @csrf @method('DELETE')
                                        <div class="flex items-center bg-gray-50 border border-gray-200 rounded-lg overflow-hidden focus-within:ring-1 focus-within:ring-red-500 transition-all">
                                            <input type="password" name="master_password" placeholder="Senha" required
                                                class="w-16 px-2 py-1 text-xs outline-none bg-transparent">
                                            <button class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 text-xs font-bold transition-colors">
                                                Apagar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($produtos->isEmpty())
                <div class="p-20 text-center">
                    <p class="text-gray-400 text-lg">Nenhum produto cadastrado no momento.</p>
                </div>
                @endif
            </div>
        </div>
    </main>

</body>
</html>
