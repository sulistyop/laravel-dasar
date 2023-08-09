<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    public function testCreateSession()
    {
        $this->get('/session/create')
            ->assertSeeText("OK")
            ->assertSessionHas("userId", "Sulis")
            ->assertSessionHas("isMember", true);
    }

    public function testGetSession()
    {
        $this->withSession([
            'userId' => 'Sulis',
            'isMember' => 'true'
        ])->get('/session/get')
            ->assertSeeText('Sulis')->assertSeeText('true');
    }

    public function testGetSessionFailed()
    {
        $this->withSession([])->get('/session/get')
            ->assertSeeText("User Id : guest, Is Member : false");
    }


}
