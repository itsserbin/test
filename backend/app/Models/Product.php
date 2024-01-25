<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Product extends Model
{
    use HasFactory;

    final public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_products');
    }

    final public function attributes(): HasMany
    {
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }

    final public function availability(): HasOne
    {
        return $this->hasOne(ProductAvailability::class, 'product_id');
    }

    final public function image(): HasOne
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }

    final public function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class, 'product_images');
    }

    final public function meta(): MorphOne
    {
        return $this->morphOne(MetaTag::class, 'taggable');
    }

    final public function characteristics(): BelongsToMany
    {
        return $this->belongsToMany(Characteristic::class, 'product_characteristics');
    }

    final public function properties(): HasMany
    {
        return $this->hasMany(ProductProperty::class, 'product_id');
    }

    final public function prices(): HasMany
    {
        return $this->hasMany(ProductPrice::class, 'product_id');
    }
}
