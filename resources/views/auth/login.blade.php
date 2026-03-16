<!DOCTYPE html>
<html>

<head>
    <title>Login - Sistema Loja</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded shadow w-96">

        <h2 class="text-2xl font-bold mb-6 text-center">
            Login do Sistema
        </h2>

        @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-2 mb-4">
            {{ $errors->first() }}
        </div>
        @endif

        <form action="{{ route('login') }}" method="POST">

            @csrf

            <input
                type="text"
                name="email"
                placeholder="email"
                class="w-full border p-2 mb-4 rounded" />

            <input
                type="password"
                name="password"
                placeholder="Senha"
                class="w-full border p-2 mb-4 rounded" />

            <button class="w-full bg-blue-500 text-white p-2 rounded">
                Entrar
            </button>

        </form>

    </div>

</body>

</html>
