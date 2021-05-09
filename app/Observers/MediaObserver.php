<?php

namespace App\Observers;

use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaObserver
{
    public function created(Media $media)
    {
        //ImageOptimizer::optimize($media->getPath());
    }
}
