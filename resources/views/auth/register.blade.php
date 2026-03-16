<!DOCTYPE html>
<html>

<head>
    <title>Cadastrar Usuário</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded shadow w-96">

        <h2 class="text-2xl font-bold mb-6 text-center">
            Criar Conta
        </h2>

        <form method="POST" action="/register">
            @csrf

            <input
                type="text"
                name="name"
                placeholder="Nome"
                class="w-full border p-2 mb-4 rounded" />

            <input
                type="email"
                name="email"
                placeholder="Email"
                class="w-full border p-2 mb-4 rounded" />

            <input
                type="password"
                name="password"
                placeholder="Senha"
                class="w-full border p-2 mb-4 rounded" />

            <input
                type="password"
                name="password_confirmation"
                placeholder="Confirmar senha"
                class="w-full border p-2 mb-4 rounded" />

            <button class="w-full bg-green-500 text-white p-2 rounded">
                Cadastrar
            </button>

        </form>

    </div>

</body>

</html>
