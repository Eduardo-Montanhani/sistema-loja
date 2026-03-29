<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Loja</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    <div class="max-w-7xl mx-auto p-8">

        <h1 class="text-3xl font-bold mb-8">🛍️ Nossos Produtos</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            @foreach($produtos as $produto)

            <div class="bg-white rounded-2xl shadow p-6 flex flex-col justify-between">

                <!-- NOME -->
                <h2 class="text-xl font-bold text-gray-800">
                    {{ $produto->nome }}
                </h2>

                <!-- PREÇO -->
                <p class="text-2xl font-black text-emerald-600 mt-2">
                    R$ {{ number_format($produto->preco_venda,2,',','.') }}
                </p>

                <!-- STATUS -->
                @if($produto->quantidade > 0)
                    <span class="text-sm text-green-600 font-bold mt-2">
                        ✔ Em estoque
                    </span>
                @else
                    <span class="text-sm text-red-500 font-bold mt-2">
                        ❌ Indisponível
                    </span>
                @endif

                <!-- BOTÃO -->
                <div class="mt-4">

                    @if($produto->quantidade > 0)

                    @php
                        $mensagem = urlencode("Olá! Tenho interesse no produto: {$produto->nome} - R$ {$produto->preco_venda}");
                    @endphp

                    <a href="https://wa.me/5511999999999?text={{ $mensagem }}"
                        target="_blank"
                        class="block text-center bg-green-500 hover:bg-green-600 text-white font-bold py-3 rounded-xl transition">

                        💬 Comprar via WhatsApp
                    </a>

                    @else

                    <button disabled
                        class="w-full bg-gray-300 text-gray-600 font-bold py-3 rounded-xl cursor-not-allowed">
                        Indisponível
                    </button>

                    @endif

                </div>

            </div>

            @endforeach

        </div>

    </div>

</body>

</html>
