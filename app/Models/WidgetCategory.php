<?php

namespace App\Models;

use App\Traits\HasCoverAndFeaturedCoverImages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class WidgetCategory extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasCoverAndFeaturedCoverImages;

    protected $fillable = [
        'name', 'type_id', 'textview_enable', 'colorpicker_enable',
        'theme_color_is_enabled', 'background_color_is_enabled',
        'text_is_enabled', 'font_is_enabled', 'is_date_enabled'
    ];

    protected $appends = [
        'limited_widgets','cover_image', 'featured_cover_image'
    ];

    protected $hidden = ['media'];

    public function getLimitedWidgetsAttribute()
    {
        return $this->widgets()->take(5)->get();
    }

    public function widget_types()
    {
        return $this->belongsToMany(WidgetType::class, "widget_category_widget_type");
    }

    public function widgets(): HasMany
    {
        return $this->hasMany(Widget::class, 'category_id');
    }

    public function widget_type()
    {
        return $this->belongsTo(WidgetType::class, "type_id");
    }
}
