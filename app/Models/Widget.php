<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public function widget_type()
    {
        return $this->belongsTo(WidgetType::class, "type_id");
    }

    public function widget_category()
    {
        return $this->belongsTo(WidgetCategory::class, "category_id");
    }
}
