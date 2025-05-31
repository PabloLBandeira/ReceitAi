<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PromptService;
use App\Helpers\PromptHelper;
use App\Helpers\RecipeHelper;
use App\Models\Skill;
use App\Models\Type;
use App\Models\Occasion;

class PromptController extends Controller
{
   protected $promptService;

   public function __construct(PromptService $promptService) 
   {
        $this->promptService = $promptService;
   }

   public function index() 
    {
    return view('cozinhar', [
        'sessionData' => $this->promptService->getSessionData(),
        'skills' => Skill::all(), 
        'occasions' => Occasion::all(), 
        'types' => Type::all() 
    ]);
    }

    public function generate(Request $request) 
    {
        $ingredients = $request->input('ingredients');
        $ingredients = PromptHelper::sanitizeText($ingredients);
        $request->merge(['ingredients' => $ingredients]);

        $data = $this->promptService->processPrompt($request);

        return view('prompts', $data);
    }

    
    public function clear ()
    {
        $this->promptService->clearSessionData();
        return redirect()->route('prompts.index');
    }

    public function share() 
    {
       $promptData = session('prompt', []);

       $temporaryRecipe = new \App\Models\Recipe([
        'title' => 'Receita gerada',
        'occasion' => $promptData['occasion'],
        'skill' => $promptData['skill'] ?? '',
        'people' => $promptData['people'] ?? 1,
        'ingredients' => $promptData['ingredients'] ?? '',
        'content' => $promptData['recipe'] ?? ''
       ]);

       return response()->json([
        'message' => RecipeHelper::generateShareMessage($temporaryRecipe)
        ]);
    }

}