<?php

namespace App\DTO\Category;

use App\DTO\BaseDTO;

class ItemCategoryDTO extends BaseDTO
{
    function __construct(
        public array $attributes = [],
        public array $meta = [],
    )
    {
        $this->attributes = [
            'title' => $this->attributes['title'],
            'slug' => $this->attributes['slug'],
            'description' => $this->attributes['description'] ?? null,
            'content' => $this->attributes['content'] ?? null,
        ];

        $this->meta = [
            'title' => $this->meta['title'] ?? null,
            'description' => $this->meta['description'] ?? null,
            'keywords' => $this->meta['keywords'] ?? null,
            'canonical' => $this->meta['canonical'] ?? null,
            'noindex' => $this->meta['noindex'] ?? false,
            'og_title' => $this->meta['og_title'] ?? null,
            'og_description' => $this->meta['og_description'] ?? null,
            'og_image' => $this->meta['og_image'] ?? null,
            'og_type' => $this->meta['og_type'] ?? null,
            'og_site_name' => $this->meta['og_site_name'] ?? null,
        ];
    }
}
