<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileControllerTest extends TestCase
{
    public function testUpload()
    {
        $this->markTestSkipped();

        //hanya bisa jalan di Unix
        $image = UploadedFile::fake()->image('sulistyo.png');
        var_dump($image);
        $this->post('/file/upload',[
           'picture' => $image
        ])->assertSeeText('sulistyo.png');
    }

}
