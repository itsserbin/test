<?php

namespace App\DTO\Image;

use App\DTO\BaseDTO;
use Illuminate\Http\File;

class UploadImageDTO extends BaseDTO
{
    function __construct(
        public mixed $image,
        public string|null $filename = null,
        public string|null $path = null,
        public string|null $alt = null,
        public string|null $title = null,
    )
    {
    }
}
