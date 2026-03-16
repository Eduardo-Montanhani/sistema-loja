<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Produtos</title>
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

            <div class="flex justify-between items-center mb-6">

                <h1 class="text-3xl font-bold">
                    Lista de Produtos
                </h1>

                <a href="{{ route('produtos.create') }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">

                    Cadastrar Produto

                </a>

            </div>

            <!-- BOTÃO VOLTAR -->

            <a href="/dashboard"
                class="inline-block mb-6 text-blue-500 hover:underline">

                ← Voltar para Dashboard

            </a>

            <!-- TABELA -->

            <div class="bg-white shadow rounded-lg overflow-hidden">

                <table class="w-full text-left">

                    <thead class="bg-gray-200">

                        <tr>

                            <th class="p-3">ID</th>
                            <th class="p-3">Nome</th>
                            <th class="p-3">Compra</th>
                            <th class="p-3">Venda</th>
                            <th class="p-3">Quantidade</th>
                            <th class="p-3">Ações</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($produtos as $produto)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="p-3">{{ $produto->id }}</td>

                            <td class="p-3 font-semibold">
                                {{ $produto->nome }}
                            </td>

                            <td class="p-3">
                                R$ {{ number_format($produto->preco_compra,2,',','.') }}
                            </td>

                            <td class="p-3 text-green-600 font-semibold">
                                R$ {{ number_format($produto->preco_venda,2,',','.') }}
                            </td>

                            <td class="p-3">
                                {{ $produto->quantidade }}
                            </td>

                            <td class="p-3 flex gap-2">

                                <a href="{{ route('produtos.edit', $produto->id) }}"
                                    class="bg-yellow-400 px-3 py-1 rounded hover:bg-yellow-500">

                                    Editar

                                </a>

                                <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">

                                        Excluir

                                    </button>

                                </form>

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
