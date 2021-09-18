<?php

namespace App\Models;

use App\Traits\HasCoverAndFeaturedCoverImages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
class WallpaperCategory extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasCoverAndFeaturedCoverImages;

    protected $fillable = ['title'];

    protected $appends = ['limited_images','cover_image', 'featured_cover_image'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
              ->width(127)
              ->height(412);

        $this->addMediaConversion('small-image')
            ->width(130)
            ->height(130);

    }

    public function getLimitedImagesAttribute()
    {
        return $this->media()
        ->limit(5)->get()->map(function($media) {
            return [
                    'normal' => $media->getFullUrl(),
                    'thumbnail' => $media->getFullUrl('thumbnail'),
                ];
        });
    }
}
