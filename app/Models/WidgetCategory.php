<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class WidgetCategory extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name', 'type_id', 'textview_enable', 'colorpicker_enable',
        'theme_color_is_enabled', 'background_color_is_enabled',
        'text_is_enabled', 'font_is_enabled'
    ];

    public function widget_types()
    {
        return $this->belongsToMany(WidgetType::class, "widget_category_widget_type");
    }

    public function widgets()
    {
        return $this->hasMany(Widget::class, 'category_id');
    }

    public function widget_type()
    {
        return $this->belongsTo(WidgetType::class, "type_id");
    }
}
