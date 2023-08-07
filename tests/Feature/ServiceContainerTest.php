<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Service\HelloService;
use App\Service\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    /**
     * Dependency Injection dengan keterangan :
     * foo1 dan foo2 adalah object yang berbeda.
     * setiap menggunakan "make(key)" object akan selalu dibuat baru.
     *
     * @test
     * @return void
     */
    public function testDependency()
    {
        $foo1 = $this->app->make(Foo::class); //new Foo()
        $foo2 = $this->app->make(Foo::class); //new Foo()

        self::assertEquals("Foo", $foo1->foo());
        self::assertEquals("Foo", $foo2->foo());

        // Dalam test ini seharusnya 2 object foo1 dan foo2 adalah object yang berbeda
        // karena di FooBarServiceProvider class Foo sudah diregistrasi menjadi singletone
        // akibatnya jika membuat class Foo baru tidak bisa dilakukan.
        // akhirnya menggunakan class Foo yang sudah tersedia.
        //self::assertNotSame($foo1, $foo2);

        self::assertSame($foo1,$foo2);
    }

    /**
     * Dependency Injection menggunakan bind: membuat dependeny injection dengan 2 Parameter
     *
     * make(key, closure)
     *
     * Jadi ketika menggunakan dependency injection yang memerlukan param yang kompleks
     * diperlukan closure untuk registrasi param
     *
     * bind() = membuat object terus menerus
     *
     * @return void
     * @test
     */
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

    /**
     * Dependency Injection Singleton :
     * membuat objek yang bisa digunakan berulang-ulang tanpa membuat object yang baru
     *
     * misalnya ketika generate 2 object yg sama menggunakan singletone,
     * jika object sudah pernah dibuat, maka akan mengembalikan atau menggunakan object yang sudah ada
     *
     * @return void
     */
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

    /**
     * Dependency Injection menggunakan instance :
     * object langsung diisikan sebagai closure
     *
     * $this->app->instance(key, object)
     *
     * @return void
     */
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

    /**
     * Dependency injection with singleton
     *
     * @return void
     */
    public function testDependencyInjection()
    {
        // registrasi signleton class Foo
        $this->app->singleton(Foo::class,function ($app){
            return new Foo();
        });

        // registrasi signleton class Bar
        // $app sebagai service container
        $this->app->singleton(Bar::class, function ($app){
            return new Bar($app->make(Foo::class));
        });

        $foo = $this->app->make(Foo::class);// object baru dipakai berkali2
        $bar1 = $this->app->make(Bar::class); //object baru dipakai berkali2
        $bar2 = $this->app->make(Bar::class); //object baru dipakai berkali2

        self::assertSame($foo, $bar1->foo);
        self::assertSame($bar1,$bar2);
    }

    public function testInterfaceToClass()
    {
        // Jika object nya simple bisa langsung menggunakan seperti ini saja.
        $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        // Jika object nya Compleks maka direkomendasikan menggunakan Closure
        $this->app->singleton(HelloService::class, function ($app){
            return new HelloServiceIndonesia();
        });
        $helloService = $this->app->make(HelloService::class);


        self::assertEquals('Hallo Sulis', $helloService->hello('Sulis'));
    }


}
