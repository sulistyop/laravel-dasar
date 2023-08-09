<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UrlGenerationTest extends TestCase
{
    public function testURLCurrent()
    {
        $this->get('/url/current?name=Sulis')
            ->assertSeeText("/url/current?name=Sulis");
    }

    public function testNamed()
    {
        $this->get('/redirect/named')
            ->assertSeeText("/redirect/name/Sulis");
    }

    public function testAction()
    {
        $this->get('/url/action')
            ->assertSeeText('/form');
    }


}
