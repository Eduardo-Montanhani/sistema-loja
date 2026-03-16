<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex">

        <!-- SIDEBAR -->

        <div class="w-64 bg-gray-900 text-white p-6">

            <h2 class="text-2xl font-bold mb-8">
                Sistema Loja
            </h2>

            <nav class="space-y-4">

                <a href="/dashboard" class="block hover:text-blue-400">
                    Dashboard
                </a>

                <a href="/produtos" class="block text-blue-400">
                    Produtos
                </a>

                <form method="POST" action="/logout">
                    @csrf
                    <button class="text-red-400 hover:text-red-600">
                        Sair
                    </button>
                </form>

            </nav>

        </div>

        <!-- CONTEÚDO -->

        <div class="flex-1 p-10">

            <h1 class="text-3xl font-bold mb-6">
                Cadastrar Produto
            </h1>

            <a href="/produtos" class="text-blue-500 hover:underline mb-6 inline-block">
                ← Voltar para Produtos
            </a>

            <!-- FORMULÁRIO -->

            <div class="bg-white p-8 rounded-lg shadow max-w-lg">

                <form method="POST" action="/produtos" class="space-y-4">

                    @csrf

                    <div>
                        <label class="block text-gray-700">Nome do Produto</label>
                        <input type="text"
                            name="nome"
                            class="w-full border rounded p-2 focus:ring focus:ring-blue-200"
                            placeholder="Ex: Playstation 5">
                    </div>

                    <div>
                        <label class="block text-gray-700">Preço de Compra</label>
                        <input type="number"
                            step="0.01"
                            name="preco_compra"
                            class="w-full border rounded p-2 focus:ring focus:ring-blue-200"
                            placeholder="Ex: 2400">
                    </div>

                    <div>
                        <label class="block text-gray-700">Preço de Venda</label>
                        <input type="number"
                            step="0.01"
                            name="preco_venda"
                            class="w-full border rounded p-2 focus:ring focus:ring-blue-200"
                            placeholder="Ex: 2900">
                    </div>

                    <div>
                        <label class="block text-gray-700">Quantidade</label>
                        <input type="number"
                            name="quantidade"
                            class="w-full border rounded p-2 focus:ring focus:ring-blue-200"
                            placeholder="Ex: 10">
                    </div>

                    <button
                        class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">

                        Salvar Produto

                    </button>

                </form>

            </div>

        </div>

    </div>

</body>

</html>
