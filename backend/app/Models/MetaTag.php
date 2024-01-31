<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'keywords',
        'canonical',
        'noindex',
        'og_title',
        'og_description',
        'og_image',
        'og_type',
        'og_site_name',
    ];
}
