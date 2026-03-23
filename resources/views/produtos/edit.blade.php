<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex">

        <!-- MENU -->

        <div class="w-64 bg-gray-900 text-white p-6">

            <h2 class="text-2xl font-bold mb-2">
                <img src="{{ asset('images/logo.png') }}" class="w-50 mx-auto mb-2">
            </h2>

            <nav class="space-y-4">

                <a href="/dashboard" class="block hover:text-blue-400">
                    Dashboard
                </a>

                <a href="/produtos" class="block text-blue-400">
                    Produtos
                </a>

                <a href="/relatorios" class="block hover:text-blue-400">
                    Relatórios
                </a>

                <form method="POST" action="/logout">
                    @csrf
                    <button class="text-red-400">
                        Sair
                    </button>
                </form>

            </nav>

        </div>

        <!-- CONTEUDO -->

        <div class="flex-1 p-10">

            <h1 class="text-3xl font-bold mb-6">
                Editar Produto
            </h1>

            <a href="/produtos" class="text-blue-500 hover:underline mb-6 inline-block">
                ← Voltar para Produtos
            </a>

            <div class="bg-white p-8 rounded-lg shadow max-w-lg">

                <form method="POST" action="{{ route('produtos.update', $produto->id) }}" class="space-y-4">

                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-gray-700">Nome do Produto</label>

                        <input
                            type="text"
                            name="nome"
                            value="{{ $produto->nome }}"
                            class="w-full border rounded p-2">
                    </div>

                    <div>
                        <label class="block text-gray-700">Preço Compra</label>

                        <input
                            type="number"
                            step="0.01"
                            name="preco_compra"
                            value="{{ $produto->preco_compra }}"
                            class="w-full border rounded p-2">
                    </div>

                    <div>
                        <label class="block text-gray-700">Preço Venda</label>

                        <input
                            type="number"
                            step="0.01"
                            name="preco_venda"
                            value="{{ $produto->preco_venda }}"
                            class="w-full border rounded p-2">
                    </div>

                    <div>
                        <label class="block text-gray-700">Quantidade</label>

                        <input
                            type="number"
                            name="quantidade"
                            value="{{ $produto->quantidade }}"
                            class="w-full border rounded p-2">
                    </div>

                    <button
                        class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600">

                        Atualizar Produto

                    </button>

                </form>

            </div>

        </div>

    </div>

</body>

</html>
