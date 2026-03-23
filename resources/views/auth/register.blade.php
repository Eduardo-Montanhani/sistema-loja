<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta - Sistema Loja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-gradient-to-br from-green-600 via-teal-700 to-emerald-800 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white/95 backdrop-blur-sm p-10 rounded-2xl shadow-2xl w-full max-w-md transform transition-all">

        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight">
                Criar Conta
            </h2>
            <div class="h-1 w-12 bg-green-500 mx-auto mt-2 rounded-full"></div>
            <p class="text-gray-500 mt-3">Preencha os dados abaixo para se registrar</p>
        </div>

        <form method="POST" action="/register" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nome Completo</label>
                <input
                    type="text"
                    name="name"
                    placeholder="Seu nome"
                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none transition-all duration-200 bg-gray-50 focus:bg-white"
                    required />
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">E-mail</label>
                <input
                    type="email"
                    name="email"
                    placeholder="exemplo@loja.com"
                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none transition-all duration-200 bg-gray-50 focus:bg-white"
                    required />
            </div>

            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Senha</label>
                    <input
                        type="password"
                        name="password"
                        placeholder="••••••••"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none transition-all duration-200 bg-gray-50 focus:bg-white"
                        required />
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Confirmar Senha</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="••••••••"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none transition-all duration-200 bg-gray-50 focus:bg-white"
                        required />
                </div>
            </div>

            <button class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-green-200 transform transition-active active:scale-95 duration-200 mt-4">
                Finalizar Cadastro
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-gray-100 text-center">
            <p class="text-gray-600">Já tem uma conta?
                <a href="/login" class="text-green-600 font-bold hover:underline decoration-2 underline-offset-4 transition-all">
                    Fazer Login
                </a>
            </p>
        </div>
    </div>

</body>
</html>
