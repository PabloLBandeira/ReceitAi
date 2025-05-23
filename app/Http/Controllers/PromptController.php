<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PromptService;
use App\Helpers\PromptHelper;

class PromptController extends Controller
{
   protected $promptService;

   public function __construct(PromptService $promptService) 
   {
        $this->promptService = $promptService;
   }

   public function index() 
   {
    $data = $this->promptService->getSessionData();
    return view('prompts.index', $data);
   }

    public function generate(Request $request) 
    {
        $ingredients = $request->input('ingredients');
        $ingredients = PromptHelper::sanitizeText($ingredients);
        $request->merge(['ingredients' => $ingredients]);

        $data = $this->promptService->processPrompt($request);

        return view('prompts.index', $data);
    }

    
    public function clear ()
    {
        $this->promptService->clearSessionData();
        return redirect()->route('prompts.index');
    }

}