<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FileStorageTest extends TestCase
{
    public function testStorage()
    {
        $filesystem = \Storage::disk("local");
        $filesystem->put("file.txt", "Sulistyo Pradana");
        $content = $filesystem->get("file.txt");
        self::assertEquals("Sulistyo Pradana", $content);
    }

    //Storage Link
    public function testStoragePublic()
    {
        $filesystem = \Storage::disk("public");
        $filesystem->put("file.txt", "Sulistyo Pradana");
        $content = $filesystem->get("file.txt");
        self::assertEquals("Sulistyo Pradana", $content);
    }


}
