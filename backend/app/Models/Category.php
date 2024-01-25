<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_id',
        'created_by',
        'updated_by',
    ];

    final public function attributes(): HasOne
    {
        return $this->hasOne(CategoryAttribute::class, 'category_id');
    }

    final public function meta(): MorphOne
    {
        return $this->morphOne(MetaTag::class, 'taggable');
    }

    final public function image(): HasOne
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }

    final public function characteristics(): BelongsToMany
    {
        return $this->belongsToMany(Characteristic::class, 'category_characteristics');
    }
}
