<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cozinhar') }}
        </h2>
    </x-slot>
    
    <div class="h-full m-auto sm:w-full md:w-9/12 lg:w-7/12">

      <main class="bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-lg p-6">
          <h1 class="mb-4 font-bold text-2xl">Criar Receita</h1>
          
          <form action="{{ route('cozinhar.generate') }}" method="POST">
              @csrf
              
              <div class="mb-4">
                  <label class="block text-sm font-medium mb-1 dark:text-[#A1A09A]">Selecione sua Habilidade</label>
                  <select name="skill" class="w-full p-2 border border-[#19140035] dark:border-[#3E3E3A] dark:bg-[#1a1a1a] rounded-sm">
                    @foreach($skills as $skill)  
                        <option value="{{ $skill->name }}">{{ $skill->name }}</option>  
                    @endforeach  
                  </select>
              </div>
              
              <div class="mb-4">
                  <label class="block text-sm font-medium mb-1 dark:text-[#A1A09A]">Selecione a ocasião</label>
                  <select name="occasion" class="w-full p-2 border border-[#19140035] dark:border-[#3E3E3A] dark:bg-[#1a1a1a] rounded-sm">
                    @foreach($occasions as $occasion)  
                        <option value="{{ $occasion->name }}">{{ $occasion->name }}</option>  
                    @endforeach   
                  </select>
              </div>
              
              <div class="mb-4">
                  <label class="block text-sm font-medium mb-1 dark:text-[#A1A09A]">Tipo de Prato</label>
                  <select name="type" class="w-full p-2 border border-[#19140035] dark:border-[#3E3E3A] dark:bg-[#1a1a1a] rounded-sm">
                    @foreach($types as $type)  
                      <option value="{{ $type->name }}">{{ $type->name }}</option>  
                    @endforeach 
                  </select>
              </div>
              
              <div class="mb-4">
                  <label class="block text-sm font-medium mb-1 dark:text-[#A1A09A]">Para quantas pessoas?</label>
                  <input type="number" name="people" min="1" max="99" value="1"
                  class="w-full p-2 border border-[#19140035] dark:border-[#3E3E3A] dark:bg-[#1a1a1a] rounded-sm" required>
                      
                  </input>
              </div>
              
              <div class="mb-6">
                  <label class="block text-sm font-medium mb-1 dark:text-[#A1A09A]">Ingredientes disponíveis</label>
                  <textarea name="ingredients" rows="4" class="w-full p-2 border border-[#19140035] dark:border-[#3E3E3A] dark:bg-[#1a1a1a] rounded-sm" required placeholder="Ex: ovos, farinha de trigo..."></textarea>
              </div>
              
              <div class="flex gap-3">
                  <button type="button" onclick="this.form.reset()" class="flex-1 py-2 px-4 border border-[#19140035] dark:border-[#3E3E3A] hover:font-semibold rounded-sm">
                      Apagar
                  </button>
                  <button type="submit" class="flex-1 py-2 px-4 border border-[#19140035] dark:border-[#3E3E3A] hover:text-white hover:font-semibold hover:bg-[#F9A03F] dark:hover:bg-[#F9A03F] rounded-sm">
                      Cozinhar
                  </button>
              </div>
          </form>
      </main>
    </div>
</body>
</x-app-layout>