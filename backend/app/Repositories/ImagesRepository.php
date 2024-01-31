<?php

namespace App\Repositories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;

class ImagesRepository extends BaseRepository
{
    final function getModelClass(): string
    {
        return Image::class;
    }
}
