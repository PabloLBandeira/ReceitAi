<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cozinhar</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] p-6 min-h-screen">
    <div class="max-w-[335px] mx-auto">

        <header class="w-full text-sm mb-6">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                            Entrar
                        </a>
                    @endif
                </nav>
            @endif
        </header>

        <main class="bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-lg p-6">
            <h1 class="mb-4 font-bold text-2xl">Criar Receita</h1>
            
            <form action="{{ route('cozinhar.generate') }}" method="POST">
                @csrf
                
                <!-- Dropdown: Skill -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1 dark:text-[#A1A09A]">Selecione sua Habilidade</label>
                    <select name="skill" class="w-full p-2 border border-[#19140035] dark:border-[#3E3E3A] dark:bg-[#1a1a1a] rounded-sm">
                        <option value="Iniciante">Iniciante</option>
                        <option value="Intermediário">Intermediário</option>
                        <option value="Avançado">Avançado</option>
                    </select>
                </div>
                
                <!-- Dropdown: Occasion -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1 dark:text-[#A1A09A]">Ocasião</label>
                    <select name="occasion" class="w-full p-2 border border-[#19140035] dark:border-[#3E3E3A] dark:bg-[#1a1a1a] rounded-sm">
                        <option value="Café da Manhã">Café da Manhã</option>
                        <option value="Almoço">Almoço</option>
                        <option value="Jantar">Jantar</option>
                        <option value="Lanche">Lanche</option>
                    </select>
                </div>
                
                <!-- Dropdown: Type -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1 dark:text-[#A1A09A]">Tipo de Prato</label>
                    <select name="type" class="w-full p-2 border border-[#19140035] dark:border-[#3E3E3A] dark:bg-[#1a1a1a] rounded-sm">
                        <option value="Entrada">Entrada</option>
                        <option value="Prato Principal">Prato Principal</option>
                        <option value="Sobremesa">Sobremesa</option>
                        <option value="Acompanhamento">Acompanhamento</option>
                    </select>
                </div>
                
                <!-- Dropdown: People -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1 dark:text-[#A1A09A]">Serve Quantas Pessoas?</label>
                    <select name="people" class="w-full p-2 border border-[#19140035] dark:border-[#3E3E3A] dark:bg-[#1a1a1a] rounded-sm">
                        @for($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                
                <!-- Textarea: Ingredientes -->
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-1 dark:text-[#A1A09A]">Ingredientes Disponíveis</label>
                    <textarea name="ingredients" rows="4" class="w-full p-2 border border-[#19140035] dark:border-[#3E3E3A] dark:bg-[#1a1a1a] rounded-sm" placeholder="Ex: 2 ovos, 1 xícara de farinha..."></textarea>
                </div>
                
                <!-- Botões -->
                <div class="flex gap-3">
                    <button type="button" onclick="this.form.reset()" class="flex-1 py-2 px-4 border border-[#19140035] dark:border-[#3E3E3A] hover:bg-[#f5f5f5] dark:hover:bg-[#252525] rounded-sm">
                        Apagar
                    </button>
                    <button type="submit" class="flex-1 py-2 px-4 bg-[#1b1b18] dark:bg-[#EDEDEC] text-white dark:text-[#1b1b18] hover:bg-[#333] dark:hover:bg-[#f0f0f0] rounded-sm">
                        Cozinhar
                    </button>
                </div>
            </form>
        </main>
    </div>
</body>
</html>