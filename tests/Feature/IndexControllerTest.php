<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use JetBrains\PhpStorm\NoReturn;
use Tests\TestCase;

class IndexControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    #[NoReturn] public function test_main(): void
    {
        $start = microtime(true);

        Artisan::call('app:generate-jwt', ['username' => 'test']);
        $token = Artisan::output();

        $this
            ->withHeader('Authorization', 'Bearer '. $token)
            ->get(route('v1.foo'))
            ->assertOk();

        $end = microtime(true);

        dd('Ping is '. round((($end-$start) * 1000)) . ' ms');
    }
}
