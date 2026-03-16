<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
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

                <a href="/produtos" class="block hover:text-blue-400">
                    Produtos
                </a>

                <a href="/relatorios" class="block hover:text-blue-400">
                    Relatorios
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
                Dashboard
            </h1>

            <!-- CARDS -->

            <div class="grid grid-cols-3 gap-6 mb-10">

                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-gray-500">Total de Produtos</p>
                    <h2 class="text-3xl font-bold">
                        {{ $totalProdutos }}
                    </h2>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-gray-500">Valor do Estoque</p>
                    <h2 class="text-3xl font-bold">
                        R$ {{ number_format($valorEstoque,2,',','.') }}
                    </h2>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-gray-500">Gerenciar</p>

                    <a href="/produtos" class="text-blue-500 font-semibold">
                        Ir para produtos →
                    </a>

                </div>

            </div>

            <!-- TABELA DE PRODUTOS -->

            <div class="bg-white rounded-lg shadow p-6">

                <h2 class="text-xl font-bold mb-4">
                    Últimos produtos cadastrados
                </h2>

                <table class="w-full">

                    <thead>

                        <tr class="text-left border-b">

                            <th class="p-2">Produto</th>
                            <th class="p-2">Compra</th>
                            <th class="p-2">Venda</th>
                            <th class="p-2">Estoque</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($produtos as $produto)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="p-2">
                                {{ $produto->nome }}
                            </td>

                            <td class="p-2">
                                R$ {{ number_format($produto->preco_compra,2,',','.') }}
                            </td>

                            <td class="p-2">
                                R$ {{ number_format($produto->preco_venda,2,',','.') }}
                            </td>

                            <td class="p-2">
                                {{ $produto->quantidade }}
                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>

</html>
