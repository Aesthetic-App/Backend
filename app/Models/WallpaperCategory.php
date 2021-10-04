<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\HasCoverAndFeaturedCoverImages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class WallpaperCategory extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasCoverAndFeaturedCoverImages;
    use SortableTrait;

  public $sortable = [
    'order_column_name' => 'sort_order',
    'sort_when_creating' => true,
  ];

    protected $fillable = ['title'];

    protected $appends = ['limited_images','cover_image', 'featured_cover_image'];

    protected $hidden = ['media'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function ($builder) {
            $builder->orderBy('sort_order', 'asc');
        });
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

    public function getImagesAttribute()
    {
        return $this->media->map(function($media) {
                return [
                    'normal' => $media->getFullUrl(),
                    'thumbnail' => $media->getFullUrl('thumbnail'),
                ];
            });
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
