<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\HasCoverAndFeaturedCoverImages;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ThemeCategory extends Model implements HasMedia
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

    protected $appends = ['limited_themes', 'cover_image', 'featured_cover_image'];

    protected $hidden = ['media'];

    protected static function boot()
    {
        parent::boot();

        // static::addGlobalScope('order', function ($builder) {
        //     $builder->orderBy('sort_order', 'asc');
        // });
    }

    public function themes()
    {
        return $this->belongsToMany(Theme::class, "theme_theme_category");
    }

    public function getLimitedThemesAttribute()
    {
        return $this->themes()->limit(5)->get();
    }
}
