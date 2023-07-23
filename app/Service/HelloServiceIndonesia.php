<?php

namespace App\Service;

class HelloServiceIndonesia implements HelloService
{

    public function hello(string $name): string
    {
        return "Hallo $name";
    }
}
