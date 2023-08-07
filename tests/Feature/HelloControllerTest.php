<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloControllerTest extends TestCase
{
    public function testController()
    {
        $this->get('/controller/hello/sulis')
            ->assertSeeText('Hallo sulis');
    }

    public function testRequest()
    {
        $this->get('/controller/hello/request',[
            "Accept" => "plain/text"
        ])->assertSeeText("controller/hello/request")
        ->assertSeeText('http://localhost:8000/controller/hello/request')
        ->assertSeeText('GET')
        ->assertSeeText('plain/text');

    }


}
