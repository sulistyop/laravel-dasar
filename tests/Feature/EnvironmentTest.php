<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetEnv()
    {
       $youtube = env('YOUTUBE','Sulistyo Pradana');
       self::assertEquals('Sulistyo Pradana', $youtube);
    }

    public function testDefaultEnv(){
        $author = env('AUTHOR','Sulis');
        self::assertEquals('Sulis', $author);
    }
}
