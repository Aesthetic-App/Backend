<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ThemeCategory extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['title'];

    protected $appends = ['cover_image_url'];

    protected $with = [];

    public function headlines()
    {
        return $this->belongsToMany(Headline::class, "theme_category_headline");
    }

    public function getCoverImageUrlAttribute()
    {
        $media = $this->getMedia("cover_image")->first();
        return $media ? $media->getFullUrl() : null;
    }

    public function images($all = false)
    {
        
    }
}
