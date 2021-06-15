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

    protected $fillable = ['name', 'type_id', 'textview_enable', 'colorpicker_enable'];

    public function widget_types()
    {
        return $this->belongsToMany(WidgetType::class, "widget_category_widget_type");
    }

    public function widget_type()
    {
        return $this->belongsTo(WidgetType::class, "type_id");
    }
}
