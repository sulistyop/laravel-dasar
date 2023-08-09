<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
   public function testResponse()
   {
        $this->get('/response/hello')
            ->assertStatus(200)
            ->assertSeeText("Hello Response");
   }

    public function testHeader()
    {
        $this->get('/response/header')
            ->assertStatus(200)
            ->assertSeeText('Sulistyo')
            ->assertSeeText('Pradana')
            ->assertHeader('Content-Type','application/json')
            ->assertHeader('Author','Sulistyo Pradana')
            ->assertHeader('App','Belajar Laravel');
    }

    public function testResponseView()
    {
        $this->get('/response/view')
            ->assertSeeText('Hello Sulis');
    }

    public function testJson()
    {
        $this->get('/response/json')
            ->assertJson([
               'firstName' => 'Sulistyo',
               'lastName' => 'Pradana',
            ]);
    }


    public function testResponseFile()
    {
        $this->get('/response/file')
        ->assertHeader('Content-Type','image/jpeg');
    }

    public function testResponseDownload()
    {
        $this->get('/response/download')
        ->assertDownload('image-lapuk.jpg');
    }


}
