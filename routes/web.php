<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromptController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/perfil', [RecipeController::class, 'index'])->name('perfil');
    
    Route::prefix('cozinhar')->group(function() {
        Route::get('/', [PromptController::class, 'index'])->name('cozinhar.index');
        Route::post('/', [PromptController::class, 'generate'])->name('cozinhar.generate');
        Route::post('/limpar', [PromptController::class, 'clear'])->name('cozinhar.clear');
        Route::post('/salvar', [RecipeController::class, 'store'])->name('cozinhar.store');
        Route::get('/compartilhar', [PromptController::class, 'share'])->name('cozinhar.share');
    });
       
    Route::prefix('minhas-receitas')->group(function() {
        Route::get('/', [ProfileController::class, 'index'])->name('receitas.index');
        Route::get('/{recipe}', [RecipeController::class, 'show'])->name('receitas.show');
        Route::get('/{recipe}/editar', [RecipeController::class, 'edit'])->name('receitas.edit');
        Route::put('/{recipe}', [RecipeController::class, 'update'])->name('receitas.update');
        Route::delete('/{recipe}', [RecipeController::class, 'destroy'])->name('receitas.destroy');
        Route::get('/filtrar', [RecipeController::class, 'filter'])->name('receitas.filter'); 
        Route::post('/{recipe}/compartilhar', [RecipeController::class, 'share'])->name('receitas.share');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

require __DIR__.'/auth.php';
