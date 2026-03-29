<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Store | Experiência Exclusiva</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #0f172a;
        }

        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass:hover {
            background: rgba(255, 255, 255, 0.07);
            border-color: rgba(16, 185, 129, 0.4);
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .product-image {
            transition: transform 0.6s ease;
        }

        .glass:hover .product-image {
            transform: scale(1.1);
        }

        /* Efeito de gradiente animado no fundo */
        .bg-glow {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 50% -20%, #1e293b, #0f172a);
            z-index: -1;
        }

        .accent-glow {
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(16, 185, 129, 0.15);
            filter: blur(100px);
            border-radius: 50%;
            z-index: -1;
            top: -100px;
            right: -100px;
        }
    </style>
</head>

<body class="text-white antialiased">
    <div class="bg-glow"></div>
    <div class="accent-glow"></div>

    <div class="max-w-7xl mx-auto p-6 md:p-12">

        <header class="mb-20 text-center" data-aos="fade-down">
            <div class="inline-block mb-6">
                <span class="text-emerald-500 font-black uppercase tracking-[0.5em] text-[10px] border-b border-emerald-500/30 pb-2">
                    Luxury Experience
                </span>
            </div>

            <h1 class="text-6xl md:text-8xl font-[900] leading-none tracking-tighter bg-clip-text text-transparent bg-gradient-to-b from-white via-white to-gray-500">
                M&M <span class="text-emerald-500 text-4xl md:text-6xl block md:inline font-light italic tracking-normal">Importados</span>
            </h1>

            <div class="flex items-center justify-center gap-4 mt-8">
                <div class="h-[1px] w-12 bg-gradient-to-r from-transparent to-emerald-500/50"></div>
                <p class="text-gray-400 text-sm md:text-base font-light tracking-wide italic">
                    Onde a exclusividade encontra o mundo.
                </p>
                <div class="h-[1px] w-12 bg-gradient-to-l from-transparent to-emerald-500/50"></div>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

            @foreach($produtos as $produto)
            <div class="glass rounded-[2.5rem] overflow-hidden flex flex-col group" data-aos="fade-up" data-aos-delay="100">

                <div class="relative overflow-hidden h-72">
                    @if($produto->imagem)
                    <img src="{{ asset('storage/' . $produto->imagem) }}"
                        alt="{{ $produto->nome }}"
                        class="product-image w-full h-full object-cover">
                    @else
                    <div class="w-full h-full bg-slate-800 flex items-center justify-center text-4xl">📦</div>
                    @endif

                    <div class="absolute top-5 right-5">
                        @if($produto->quantidade > 0)
                        <span class="bg-emerald-500/20 backdrop-blur-md text-emerald-400 text-[10px] font-black uppercase px-4 py-2 rounded-full border border-emerald-500/30">
                            Em Estoque
                        </span>
                        @else
                        <span class="bg-red-500/20 backdrop-blur-md text-red-400 text-[10px] font-black uppercase px-4 py-2 rounded-full border border-red-500/30">
                            Esgotado
                        </span>
                        @endif
                    </div>
                </div>

                <div class="p-8">
                    <h2 class="text-2xl font-bold text-white mb-2 group-hover:text-emerald-400 transition-colors">
                        {{ $produto->nome }}
                    </h2>

                    <div class="flex items-end justify-between mt-6">
                        <div class="flex flex-col">
                            <span class="text-gray-500 text-xs uppercase font-bold tracking-widest mb-1">Investimento</span>
                            <p class="text-3xl font-extrabold text-white">
                                <span class="text-emerald-500 text-sm font-medium mr-1">R$</span>{{ number_format($produto->preco_venda,2,',','.') }}
                            </p>
                        </div>

                        @if($produto->quantidade > 0)
                        @php
                        $mensagem = urlencode("Olá! Fiquei fascinado pelo produto: {$produto->nome}. Poderia me dar mais detalhes sobre a compra?");
                        @endphp
                        <a href="https://wa.me/?text={{ $mensagem }}"
                            target="_blank"
                            class="bg-white hover:bg-emerald-500 text-black hover:text-white w-14 h-14 rounded-2xl flex items-center justify-center transition-all duration-500 shadow-xl group-hover:rotate-[360deg]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </a>
                        @endif
                    </div>

                    @if($produto->quantidade > 0)
                    <a href="https://wa.me/5511999999999?text={{ $mensagem }}"
                        target="_blank"
                        class="mt-8 block text-center border border-white/10 hover:border-emerald-500/50 py-4 rounded-2xl text-sm font-bold uppercase tracking-widest transition-all hover:bg-emerald-500/10">
                        Garantir este item
                    </a>
                    @else
                    <button disabled class="mt-8 w-full border border-white/5 py-4 rounded-2xl text-sm font-bold uppercase tracking-widest text-gray-600 cursor-not-allowed">
                        Aguardando Reposição
                    </button>
                    @endif
                </div>
            </div>
            @endforeach

        </div>

        <footer class="mt-32 pb-12 text-center text-gray-600 text-sm font-medium tracking-widest uppercase">
            &copy; 2026 M&M importados Store — All Rights Reserved
        </footer>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
        });
    </script>
</body>

</html>
