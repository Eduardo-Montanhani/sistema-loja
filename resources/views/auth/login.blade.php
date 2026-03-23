<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Moderno - Sistema Loja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-600 via-indigo-700 to-purple-800 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white/95 backdrop-blur-sm p-10 rounded-2xl shadow-2xl w-full max-w-md transform transition-all hover:scale-[1.01]">

        <div class="text-center mb-10">
            <div class="inline-block transition-transform duration-500 hover:scale-110 cursor-default">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-48 mx-auto mb-6 drop-shadow-xl">
            </div>
            <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight">
                Bem-vindo de volta
            </h2>
            <div class="h-1 w-16 bg-indigo-600 mx-auto mt-2 rounded-full"></div>
            <p class="text-gray-500 mt-3">Acesse sua conta para continuar</p>
        </div>

        @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r-lg animate-pulse">
            <p class="text-sm font-medium">{{ $errors->first() }}</p>
        </div>
        @endif

        <form method="POST" action="/login" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">E-mail</label>
                <input
                    type="email"
                    name="email"
                    placeholder="exemplo@loja.com"
                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition-all duration-200 bg-gray-50 focus:bg-white"
                    required />
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Senha</label>
                <input
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition-all duration-200 bg-gray-50 focus:bg-white"
                    required />
            </div>

            <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-indigo-200 transform transition-active active:scale-95 duration-200">
                Entrar no Sistema
            </button>
        </form>

        <!-- <div class="mt-8 pt-6 border-t border-gray-100 text-center">
            <p class="text-gray-600">Não tem uma conta?
                <a href="/register" class="text-indigo-600 font-bold hover:underline decoration-2 underline-offset-4 transition-all">
                    Criar conta agora
                </a>
            </p>
        </div> -->
    </div>

</body>

</html>
