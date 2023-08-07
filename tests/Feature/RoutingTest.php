<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function Symfony\Component\Translation\t;

class RoutingTest extends TestCase
{
    public function testGet(){
        $this->get('/sulis')
            ->assertStatus(200)
            ->assertSeeText('Sulistyo Pradana -');
    }

    public function testRedirect()
    {
        $this->get('/youtube')
            ->assertRedirect('/sulis');
    }

    public function testFallback()
    {
        $this->get('/tidak')
            ->assertSeeText('404 Maaf tidak ada bosku');
    }

    public function testRouteParameter()
    {
        $this->get('/products/1')
            ->assertSeeText('Product : 1');
        $this->get('/products/2')
            ->assertSeeText('Product : 2');

        $this->get('/products/1/items/XXX')
            ->assertSeeText('Product : 1, Items : XXX');
    }

    public function testRouteParameterRegex()
    {
        $this->get('/categories/1')
            ->assertSeeText('Categories : 1');
        $this->get('/categories/XXX')
            ->assertSeeText('404');
    }

    public function testRouteParameterOptional()
    {
        $this->get('/users/sulis')
            ->assertSeeText('Users : sulis');
        $this->get('/users/')
            ->assertSeeText('404');
    }

    public function testRouteParameterConflict()
    {
        $this->get('/conflict/budi')
            ->assertSeeText('Conflict budi');

        $this->get('/conflict/sulis')
            ->assertSeeText('Conflict Sulistyo');
    }

    public function testNamedRoute()
    {
        $appUrl = env('APP_URL');
        $this->get('/produk/12345')
            ->assertSeeText("Link : $appUrl/products/12345");

        $this->get('/produk-redirect/12345')
            ->assertRedirect('/products/12345');
    }


}
