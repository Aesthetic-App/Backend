<?php

namespace App\Models;

use App\Traits\HasCoverAndFeaturedCoverImages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ThemeCategory extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasCoverAndFeaturedCoverImages;

    protected $fillable = ['title'];

    protected $appends = ['limited_themes', 'cover_image', 'featured_cover_image'];

    public function themes()
    {
        return $this->belongsToMany(Theme::class, "theme_theme_category");
    }

    public function getLimitedThemesAttribute()
    {
        return $this->themes()->limit(5)->get();
    }
}
