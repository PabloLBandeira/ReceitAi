<?php

namespace Tests\Unit;

use App\Services\PromptService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class PromptServiceTest extends TestCase
{
    protected PromptService $promptService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->promptService = new PromptService();
        Session::start();
    }

    protected function tearDown(): void
    {
        Session::flush();
        parent::tearDown();
    }

    /** @test */
    public function it_rejects_empty_requests()
    {
        $request = new Request();
        $result = $this->promptService->processPrompt($request);
        
        $this->assertIsArray($result);
        $this->assertArrayHasKey('error', $result);
        $this->assertStringContainsString('obrigatório', $result['error']);
    }

    /** @test */
    public function it_rejects_invalid_people_counts()
    {
        $request = new Request([
            'occasion' => 'Dinner',
            'type' => 'Main',
            'skill' => 'Beginner',
            'people' => '0',
            'ingredients' => 'Tomato, Onion'
        ]);
        
        $result = $this->promptService->processPrompt($request);
        
        $this->assertIsArray($result);
        $this->assertArrayHasKey('error', $result);
        $this->assertStringContainsString('O número de pessoas deve  estar entre 1 e 99', $result['error']);
    }

    /** @test */
    public function it_accepts_zero_in_input_but_fails_in_people_validation()
    {
        $request = new Request([
            'occasion' => 'Dinner',
            'type' => 'Main',
            'skill' => 'Beginner',
            'people' => '0',
            'ingredients' => 'Tomato, Onion'
        ]);
        
        $result = $this->promptService->processPrompt($request);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('error', $result);
        $this->assertStringContainsString('O número de pessoas deve  estar entre 1 e 99', $result['error']);
    }

    /** @test */
    public function it_processes_valid_requests()
    {
        $request = new Request([
            'occasion' => 'Dinner',
            'type' => 'Main',
            'skill' => 'Beginner',
            'people' => '4',
            'ingredients' => 'Tomato, Onion'
        ]);

        $result = $this->promptService->processPrompt($request);

        $this->assertEquals('Dinner', $result['prompt.occasion']);
        $this->assertEquals('Main', $result['prompt.type']);
        $this->assertEquals('Beginner', $result['prompt.skill']);
        $this->assertEquals('4', $result['prompt.people']);
        $this->assertEquals('Tomato, Onion', $result['prompt.ingredients']);
        $this->assertStringContainsString('Receita fictícia para 4 pessoas', $result['prompt.recipe']);
    }

    /** @test */
    public function it_gets_session_data()
    {
        session([
            'prompt.occasion' => 'Dinner',
            'prompt.type' => 'Main',
            'prompt.skill' => 'Beginner',
            'prompt.people' => '4',
            'prompt.ingredients' => 'Tomato, Onion',
            'prompt.recipe' => 'Test recipe'
        ]);

        $data = $this->promptService->getSessionData();

        $this->assertEquals('Dinner', $data['occasion']);
        $this->assertEquals('Main', $data['type']);
        $this->assertEquals('Beginner', $data['skill']);
        $this->assertEquals('4', $data['people']);
        $this->assertEquals('Tomato, Onion', $data['ingredients']);
        $this->assertEquals('Test recipe', $data['recipe']);
    }

    /** @test */
    public function it_clears_session_data()
    {
        session(['prompt.occasion' => 'Dinner']);
        $this->promptService->clearSessionData();
        $this->assertNull(session('prompt.occasion'));
    }
}