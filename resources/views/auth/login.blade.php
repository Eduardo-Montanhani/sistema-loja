<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Ultra Moderno - Sistema Loja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tsparticles-confetti@2.12.0/tsparticles.confetti.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tsparticles/2.12.0/tsparticles.bundle.min.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            overflow: hidden;
            /* Impede scroll por causa das partículas */
        }

        #tsparticles {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
            background: radial-gradient(circle at center, #1e1b4b 0%, #0f172a 100%);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-4">

    <div id="tsparticles"></div>

    <div class="glass-card p-10 rounded-[2rem] shadow-[0_20px_50px_rgba(0,0,0,0.3)] w-full max-w-md transform transition-all duration-500 hover:shadow-indigo-500/20 border-t border-white/50">

        <div class="text-center mb-10">
            <div class="relative inline-block mb-6 group">
                <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="relative w-48 mx-auto drop-shadow-2xl">
            </div>

            <h2 class="text-3xl font-[800] text-slate-900 tracking-tight">
                Painel Administrativo
            </h2>
            <p class="text-slate-500 mt-2 font-medium">Insira suas credenciais de acesso</p>
        </div>

        @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-xl animate-bounce">
            <p class="text-xs font-black uppercase tracking-widest">{{ $errors->first() }}</p>
        </div>
        @endif

        <form method="POST" action="/login" class="space-y-4">
            @csrf

            <div class="space-y-1">
                <label class="block text-[10px] uppercase font-black text-slate-400 ml-4 tracking-widest">E-mail Corporativo</label>
                <input
                    type="email"
                    name="email"
                    placeholder="exemplo@loja.com"
                    class="w-full px-5 py-4 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all duration-300 bg-slate-50/50 focus:bg-white text-slate-700"
                    required />
            </div>

            <div class="space-y-1">
                <label class="block text-[10px] uppercase font-black text-slate-400 ml-4 tracking-widest">Senha de Segurança</label>
                <input
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    maxlength=6
                    class="w-full px-5 py-4 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all duration-300 bg-slate-50/50 focus:bg-white text-slate-700"
                    required />
            </div>

            <button class="group relative w-full bg-slate-900 hover:bg-black text-white font-bold py-4 rounded-2xl shadow-2xl transition-all duration-300 overflow-hidden active:scale-[0.98]">
                <div class="absolute inset-0 w-1/2 h-full bg-white/5 skew-x-[-20deg] group-hover:translate-x-[250%] transition-transform duration-700"></div>
                <span class="relative">Acessar Sistema</span>
            </button>
        </form>

        <div class="mt-8 text-center">
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em]">Criptografia de 256 bits ativada</p>
        </div>
    </div>

    <script>
        tsParticles.load("tsparticles", {
            fpsLimit: 120,
            interactivity: {
                events: {
                    onClick: {
                        enable: true,
                        mode: "push"
                    },
                    onHover: {
                        enable: true,
                        mode: "grab", // Cria os "raios" que ligam ao mouse
                    },
                    resize: true,
                },
                modes: {
                    grab: {
                        distance: 200,
                        links: {
                            opacity: 0.5,
                            color: "#6366f1"
                        }
                    },
                    push: {
                        quantity: 4
                    },
                },
            },
            particles: {
                color: {
                    value: "#6366f1"
                },
                links: {
                    color: "#6366f1",
                    distance: 150,
                    enable: true,
                    opacity: 0.2,
                    width: 1,
                },
                move: {
                    direction: "none",
                    enable: true,
                    outModes: {
                        default: "bounce"
                    },
                    random: false,
                    speed: 1,
                    straight: false,
                },
                number: {
                    density: {
                        enable: true,
                        area: 800
                    },
                    value: 80,
                },
                opacity: {
                    value: 0.3
                },
                shape: {
                    type: "circle"
                },
                size: {
                    value: {
                        min: 1,
                        max: 3
                    }
                },
            },
            detectRetina: true,
        });
    </script>
</body>

</html>
