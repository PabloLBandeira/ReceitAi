<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Meu perfil') }}
        </h2>
    </x-slot>

    <div class="h-full m-auto sm:w-full md:w-9/12 lg:w-7/12 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>Minhas receitas</h1>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>