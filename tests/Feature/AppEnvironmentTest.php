<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class AppEnvironmentTest extends TestCase
{
    /**
     * Check Environment Condition
     *
     * @return void
     */
    public function testAppEnv()
    {
        if(App::environment('testing','prod','dev')){
            self::assertTrue(true);
        }
    }
}
