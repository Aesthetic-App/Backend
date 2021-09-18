<?php

namespace App\Traits;

trait HasCoverAndFeaturedCoverImages 
{
    public function getCoverImageAttribute()
    {
        return $this->getFirstMediaUrl("cover_image");
    }

    public function getFeaturedCoverImageAttribute()
    {
        return $this->getFirstMediaUrl("featured_cover_image");
    }
}