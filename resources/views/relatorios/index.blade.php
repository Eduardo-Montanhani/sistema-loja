<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Relatórios</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex">

        <!-- MENU -->

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
                    <button class="text-red-400">
                        Sair
                    </button>
                </form>

            </nav>

        </div>

        <!-- CONTEUDO -->

        <div class="flex-1 p-10">

            <h1 class="text-3xl font-bold mb-6">
                Relatório de Lucro dos Produtos
            </h1>

            <div class="bg-white shadow rounded-lg overflow-hidden">

                <table class="w-full table-auto">

                    <thead class="bg-gray-200 text-left">

                        <tr>

                            <th class="p-4">Produto</th>
                            <th class="p-4 text-right">Compra</th>
                            <th class="p-4 text-right">Venda</th>
                            <th class="p-4 text-right">Lucro</th>
                            <th class="p-4 text-right">% Lucro</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($produtos as $produto)

                        @php
                        $lucro = $produto->preco_venda - $produto->preco_compra;
                        $porcentagem = ($lucro / $produto->preco_compra) * 100;
                        @endphp

                        <tr class="border-b hover:bg-gray-50">

                            <td class="p-4 font-semibold">
                                {{ $produto->nome }}
                            </td>

                            <td class="p-4 text-right">
                                R$ {{ number_format($produto->preco_compra,2,',','.') }}
                            </td>

                            <td class="p-4 text-right">
                                R$ {{ number_format($produto->preco_venda,2,',','.') }}
                            </td>

                            <td class="p-4 text-right text-green-600 font-bold">
                                R$ {{ number_format($lucro,2,',','.') }}
                            </td>

                            <td class="p-4 text-right text-blue-600 font-bold">
                                {{ number_format($porcentagem,1) }}%
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
