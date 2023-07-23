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

    public function testSingleton()
    {
        // Closure
        $this->app->singleton(Person::class, function ($app){
            return new Person("Sulistyo","Pradana");
        });

        $person1 = $this->app->make(Person::class);// closure() // new Person("Sulistyo","Pradana"); if not exist
        $person2 = $this->app->make(Person::class);// return existing , mengembalikan yg sudah ada

        self::assertEquals('Sulistyo', $person1->firstName);
        self::assertEquals('Sulistyo', $person2->firstName);

        self::assertSame($person1, $person2);
    }

    public function testInstance()
    {
        $person = new Person("Sulistyo", "Pradana");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class);// $person
        $person2 = $this->app->make(Person::class);//

        self::assertEquals('Sulistyo', $person1->firstName);
        self::assertEquals('Sulistyo', $person2->firstName);

        self::assertSame($person1, $person2);
    }

}
