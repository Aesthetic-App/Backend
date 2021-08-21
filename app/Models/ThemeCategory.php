<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ThemeCategory extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['title'];

    protected $appends = ['cover_image_url'];

    protected $with = [];

    protected $hidden = ['media'];

    public function headlines()
    {
        return $this->belongsToMany(Headline::class, "theme_category_headline");
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
              ->width(127)
              ->height(412);

        $this->addMediaConversion('small-image')
            ->width(130)
            ->height(130);
    }

    public function getCoverImageUrlAttribute()
    {
        $media = $this->getMedia("cover_image")->first();
        return $media ? $media->getFullUrl() : null;
    }
}
