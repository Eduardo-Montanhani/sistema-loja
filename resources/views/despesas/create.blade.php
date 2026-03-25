<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Despesa - Sistema Loja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-700 via-slate-800 to-slate-900 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white/95 backdrop-blur-sm p-10 rounded-2xl shadow-2xl w-full max-w-md transform transition-all border border-white/20">

        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-amber-100 text-amber-600 rounded-full mb-4 text-3xl shadow-inner">
                💸
            </div>
            <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight">
                Nova Despesa
            </h2>
            <div class="h-1 w-12 bg-amber-500 mx-auto mt-2 rounded-full"></div>
            <p class="text-gray-500 mt-3">Registre uma saída de caixa do sistema</p>
        </div>

        <form method="POST" action="{{ route('despesas.store') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Descrição da Despesa</label>
                <input
                    type="text"
                    name="nome"
                    placeholder="Ex: Aluguel, Luz, Fornecedor..."
                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-transparent outline-none transition-all duration-200 bg-gray-50 focus:bg-white"
                    required />
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Valor (R$)</label>
                <div class="relative">
                    <span class="absolute left-4 top-3 text-gray-400 font-medium">R$</span>
                    <input
                        type="number"
                        step="0.01"
                        name="valor"
                        placeholder="0,00"
                        class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-transparent outline-none transition-all duration-200 bg-gray-50 focus:bg-white font-mono"
                        required />
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Data do Gasto</label>
                <input
                    type="date"
                    name="data"
                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-transparent outline-none transition-all duration-200 bg-gray-50 focus:bg-white text-gray-600"
                    required />
            </div>

            <div class="pt-2">
                <button class="w-full bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 rounded-xl shadow-lg shadow-amber-200 transform transition-all active:scale-95 duration-200 flex items-center justify-center gap-2">
                    <span>💾</span> Salvar Despesa
                </button>
            </div>
        </form>

        <div class="mt-8 pt-6 border-t border-gray-100 text-center">
            <a href="/dashboard" class="text-gray-500 text-sm font-medium hover:text-amber-600 transition-colors">
                ← Cancelar e voltar ao Dashboard
            </a>
        </div>
    </div>

</body>
</html>
