<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieControllerTest extends TestCase
{
    public function testCreateCookie()
    {
        $this->get('/cookie/set')
            ->assertSeeText("Hello Cookie")
            ->assertCookie("User-Id", "Sulis")
            ->assertCookie("Is-Member", "true");
    }

    public function testGetCookie()
    {
        $this->withCookie('User-Id', 'Sulis')
            ->withCookie('Is-Member', 'true')
            ->get('/cookie/get')
            ->assertJson([
                "UserId" => "Sulis",
                "isMember" => "true",
            ]);
    }
}
