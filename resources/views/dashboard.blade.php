<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Formulário de Receita -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-4">Gerar Nova Receita</h3>
                        
                        <form id="recipeForm" class="space-y-4">
                            <!-- Ingredientes -->
                            <div>
                                <label for="ingredients" class="block text-sm font-medium text-gray-700">Ingredientes</label>
                                <div class="mt-1">
                                    <input type="text" id="ingredientInput" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Digite um ingrediente e pressione Enter">
                                </div>
                                <div id="ingredientsList" class="mt-2 flex flex-wrap gap-2"></div>
                            </div>

                            <!-- Nível de Habilidade -->
                            <div>
                                <label for="skill" class="block text-sm font-medium text-gray-700">Nível de Habilidade</label>
                                <select id="skill" name="skill_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="">Selecione...</option>
                                    @foreach($skills as $skill)
                                        <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Tipo de Comida -->
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Tipo de Comida</label>
                                <select id="type" name="type_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="">Selecione...</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Ocasião -->
                            <div>
                                <label for="occasion" class="block text-sm font-medium text-gray-700">Ocasião</label>
                                <select id="occasion" name="occasion_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="">Selecione...</option>
                                    @foreach($occasions as $occasion)
                                        <option value="{{ $occasion->id }}">{{ $occasion->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Gerar Receita
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Receita Gerada -->
                    <div id="generatedRecipe" class="hidden mb-8">
                        <h3 class="text-lg font-semibold mb-4">Receita Gerada</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div id="recipeContent"></div>
                            <div class="mt-4 flex justify-end space-x-4">
                                <button id="saveRecipe" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Salvar Receita
                                </button>
                                <button id="shareWhatsApp" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    Compartilhar no WhatsApp
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Lista de Receitas Salvas -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Minhas Receitas</h3>
                        
                        <!-- Filtros -->
                        <div class="mb-4 flex space-x-4">
                            <select id="filterSkill" class="block w-40 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">Todas as habilidades</option>
                                @foreach($skills as $skill)
                                    <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                                @endforeach
                            </select>

                            <select id="filterType" class="block w-40 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">Todos os tipos</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>

                            <select id="filterOccasion" class="block w-40 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">Todas as ocasiões</option>
                                @foreach($occasions as $occasion)
                                    <option value="{{ $occasion->id }}">{{ $occasion->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Lista de Receitas -->
                        <div id="savedRecipes" class="space-y-4">
                            @foreach($recipes as $recipe)
                                <div class="bg-white border rounded-lg p-4 hover:shadow-md transition-shadow cursor-pointer" data-recipe-id="{{ $recipe->id }}">
                                    <h4 class="font-semibold">{{ $recipe->title }}</h4>
                                    <div class="text-sm text-gray-600 mt-2">
                                        <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs font-semibold text-gray-600 mr-2">
                                            {{ $recipe->skill->name }}
                                        </span>
                                        <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs font-semibold text-gray-600 mr-2">
                                            {{ $recipe->type->name }}
                                        </span>
                                        <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs font-semibold text-gray-600">
                                            {{ $recipe->occasion->name }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Receita -->
    <div id="recipeModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg max-w-2xl w-full p-6">
                <div class="flex justify-between items-start mb-4">
                    <h3 id="modalTitle" class="text-lg font-semibold"></h3>
                    <button id="closeModal" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Fechar</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div id="modalContent" class="prose max-w-none"></div>
                <div class="mt-6 flex justify-end space-x-4">
                    <button id="modalShareWhatsApp" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Compartilhar no WhatsApp
                    </button>
                    <button id="modalDeleteRecipe" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Excluir Receita
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Implementação do JavaScript será adicionada aqui
    </script>
    @endpush
</x-app-layout>
