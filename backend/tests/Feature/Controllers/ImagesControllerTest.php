<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImagesControllerTest extends TestCase
{
    use WithFaker;

    final public function testUpload(): void
    {
//        Storage::fake('public');

        $image = UploadedFile::fake()->image($this->faker->image);

        $data = [
            'image' => $image
        ];

        $response = $this->postJson(route('api.images.upload'), $data);
        $response->dd();
    }
}
