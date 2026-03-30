<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M&M Importados | Luxury Experience</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --apple-bg: #000000;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--apple-bg);
            overflow-x: hidden;
        }

        .mesh-gradient {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: -1;
            background-color: #000000;
            background-image:
                radial-gradient(at 0% 0%, rgba(16, 185, 129, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(59, 130, 246, 0.1) 0px, transparent 50%),
                radial-gradient(at 50% 50%, rgba(15, 23, 42, 1) 0px, transparent 80%);
            background-attachment: fixed;
        }

        .mesh-sphere {
            position: fixed;
            width: 60vw; height: 60vw;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.08) 0%, rgba(0,0,0,0) 70%);
            border-radius: 50%;
            z-index: -1;
            filter: blur(80px);
            animation: move 20s infinite alternate;
        }

        @keyframes move {
            from { transform: translate(-10%, -10%); }
            to { transform: translate(20%, 20%); }
        }

        .glass {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(25px) saturate(180%);
            -webkit-backdrop-filter: blur(25px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .glass:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.2);
            transform: scale(1.02);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.5);
        }

        .product-image {
            transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .glass:hover .product-image {
            transform: scale(1.08);
        }

        .apple-text-gradient {
            background: linear-gradient(180deg, #ffffff 0%, rgba(255, 255, 255, 0.5) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #000; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #10b981; }

        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>

<body class="text-white antialiased">
    <div class="mesh-gradient"></div>
    <div class="mesh-sphere" style="top: -10%; left: -10%;"></div>
    <div class="mesh-sphere" style="bottom: -10%; right: -10%; animation-delay: -5s; background: radial-gradient(circle, rgba(59, 130, 246, 0.05) 0%, rgba(0,0,0,0) 70%);"></div>

    <div class="max-w-7xl mx-auto p-6 md:p-12">

        <header class="mb-24 text-center" data-aos="fade-down">
            <div class="inline-flex items-center gap-2 mb-8 bg-white/5 border border-white/10 px-4 py-1.5 rounded-full backdrop-blur-md">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                <span class="text-white/70 font-medium uppercase tracking-[0.3em] text-[9px]">
                    Coleção Importada 2026
                </span>
            </div>

            <h1 class="text-6xl md:text-8xl font-[800] leading-none tracking-tight apple-text-gradient mb-4">
                M&M <span class="font-light italic">Importados</span>
            </h1>

            <p class="text-gray-500 text-lg md:text-xl font-medium tracking-tight max-w-2xl mx-auto">
                Design minimalista. <span class="text-white">Qualidade máxima.</span>
            </p>
        </header>

        <div class="max-w-xl mx-auto mb-24" data-aos="fade-up" data-aos-delay="200">
            <form method="GET" action="{{ route('loja.index') }}" class="relative group">
                <input
                    type="text"
                    name="busca"
                    value="{{ $busca }}"
                    placeholder="Buscar na M&M..."
                    class="w-full bg-white/[0.03] border border-white/10 backdrop-blur-xl rounded-2xl px-6 py-5 outline-none focus:border-white/30 focus:bg-white/[0.06] transition-all text-white placeholder:text-gray-600 font-medium"
                >
                <button class="absolute right-3 top-3 bottom-3 bg-white text-black hover:bg-gray-200 px-6 rounded-xl font-bold transition-all flex items-center gap-2 active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <span class="hidden md:block">Buscar</span>
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($produtos as $produto)
            <div class="glass rounded-[2rem] overflow-hidden flex flex-col group" data-aos="fade-up">

                <div class="relative overflow-hidden h-64 bg-[#0a0a0a]">
                    @if($produto->imagem)
                        <img src="{{ asset('storage/' . $produto->imagem) }}"
                             alt="{{ $produto->nome }}"
                             class="product-image w-full h-full object-cover opacity-90 group-hover:opacity-100">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-4xl opacity-20">📦</div>
                    @endif

                    <div class="absolute top-4 left-4">
                        @if($produto->quantidade > 0)
                            <div class="bg-white/10 backdrop-blur-md border border-white/10 px-3 py-1 rounded-full">
                                <span class="text-[9px] font-bold text-white/90 uppercase tracking-tighter">Disponível</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="p-6">
                    <h2 class="text-xl font-semibold text-white/90 mb-1 group-hover:text-white transition-colors line-clamp-1 tracking-tight">
                        {{ $produto->nome }}
                    </h2>
                    <p class="text-gray-500 text-[10px] uppercase tracking-widest font-bold mb-4">Original Series</p>

                    <div class="flex items-center justify-between mt-auto">
                        <div class="flex flex-col">
                            <p class="text-2xl font-bold text-white">
                                <span class="text-xs font-normal text-gray-500 mr-0.5">R$</span>{{ number_format($produto->preco_venda,2,',','.') }}
                            </p>
                        </div>

                        @if($produto->quantidade > 0)
                            @php
                                $mensagem = urlencode("Olá M&M Importados! Tenho interesse no {$produto->nome}. Como posso prosseguir?");
                            @endphp
                            <a href="https://wa.me/5511999999999?text={{ $mensagem }}"
                                target="_blank"
                                class="bg-emerald-500 hover:bg-emerald-400 text-black w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300 shadow-lg shadow-emerald-500/20 active:scale-90">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        @endif
                    </div>

                    <div class="mt-6">
                        @if($produto->quantidade > 0)
                        <a href="https://wa.me/5511999999999?text={{ $mensagem }}"
                            target="_blank"
                            class="block w-full text-center bg-white hover:bg-gray-200 text-black py-3 rounded-xl text-xs font-bold transition-all active:scale-95">
                            Comprar Agora
                        </a>
                        @else
                        <button disabled class="w-full bg-white/5 border border-white/10 py-3 rounded-xl text-xs font-bold text-gray-600 cursor-not-allowed">
                            Indisponível
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <footer class="mt-40 pb-16 border-t border-white/5 pt-16">
            <div class="flex flex-col md:flex-row justify-between items-center gap-10">
                <div class="space-y-4">
                    <h3 class="text-2xl font-bold apple-text-gradient">M&M <span class="font-light italic">Importados</span></h3>
                    <p class="text-gray-500 text-sm max-w-xs">A melhor curadoria de produtos globais, entregues com exclusividade.</p>
                </div>
                <div class="flex gap-8 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-600">
                    <a href="#" class="hover:text-white transition-colors">Privacidade</a>
                    <a href="#" class="hover:text-white transition-colors">Termos</a>
                    <a href="#" class="hover:text-white transition-colors">Suporte</a>
                </div>
            </div>
            <p class="text-center mt-20 text-[10px] text-gray-700 font-bold uppercase tracking-[0.3em]">
                &copy; 2026 M&M Importados Store — Designed for Excellence
            </p>
        </footer>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1200,
            once: true,
            easing: 'ease-out-back'
        });
    </script>
</body>

</html>
