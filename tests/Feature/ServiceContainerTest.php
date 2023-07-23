<?php

namespace Tests\Feature;

use App\Data\Foo;
use App\Data\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    public function testDependencyInjection()
    {
        $foo1 = $this->app->make(Foo::class); //new Foo()
        $foo2 = $this->app->make(Foo::class); //new Foo()

        self::assertEquals("Foo", $foo1->foo());
        self::assertEquals("Foo", $foo2->foo());
        self::assertNotSame($foo1, $foo2);
    }
    public function testBind()
    {
        // Closure
        $this->app->bind(Person::class, function ($app){
            return new Person("Sulistyo","Pradana");
        });

        $person1 = $this->app->make(Person::class);// closure() // new Person("Sulistyo","Pradana");
        $person2 = $this->app->make(Person::class);// closure() // new Person("Sulistyo","Pradana");

        self::assertEquals('Sulistyo', $person1->firstName);
        self::assertEquals('Sulistyo', $person2->firstName);

        self::assertNotSame($person1, $person2);
    }

}
