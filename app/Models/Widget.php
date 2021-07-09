<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Widget extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name', 'category_id', 'type_id',
        'theme_hex_color', 'background_hex_color', 'font_name', 'text'
    ];

    protected $appends = [
        'background_image'
    ];

    private $excludedFieldsToArray = [
        'media'
    ];

    public function widget_type()
    {
        return $this->belongsTo(WidgetType::class, "type_id");
    }

    public function widget_category()
    {
        return $this->belongsTo(WidgetCategory::class, "category_id");
    }

    public function getBackgroundImageAttribute()
    {
        return $this->getFirstMediaUrl("background_images");
    }

    public function toArray()
    {
        $array = parent::toArray();
        return Arr::except($array, $this->excludedFieldsToArray);
    }
}
