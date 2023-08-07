<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        // Query Parameter
        $this->get('/input/hello?name=Sulis')
            ->assertSeeText('Hello Sulis');

        // Post Form
        $this->post('/input/hello', [
            "name" => "Sulis"
        ])->assertSeeText('Hello Sulis');
    }

    public function testNestedInput()
    {
        $this->post('/input/hello/first',[
            "name"=>[
                'first' => 'Sulistyo',
                'last' => 'Pradana'
            ]
        ])->assertSeeText('Sulistyo');
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input?base=test',[
            "name"=>[
                'first' => 'Sulistyo',
                'last' => 'Pradana'
            ]
        ])->assertSeeText('name')
        ->assertSeeText('first')
        ->assertSeeText('last')
        ->assertSeeText('Sulistyo')
        ->assertSeeText('Pradana')
        ->assertSeeText('base')
        ->assertSeeText('test');
    }

    public function testArrayInput()
    {
        $this->post('/input/hello/array',[
            "products"=>[
                [
                    "name" => "Apple Mac Book Pro",
                    "price" => 3000000
                ],
                [
                    "name" => "Samsung Galaxy S10",
                    "price" => 3000000
                ],
            ]
        ])->assertSeeText('Apple Mac Book Pro')
        ->assertSeeText('Samsung Galaxy S10');
    }

    public function testInputType()
    {
        $this->post('/input/hello/type',[
           "name" => "Sulis",
           "married" => true,
           "birth_date" => '1999-04-30'
        ])->assertSeeText('Sulis')
        ->assertSeeText('true')
        ->assertSeeText('1999-04-30');
    }


}
