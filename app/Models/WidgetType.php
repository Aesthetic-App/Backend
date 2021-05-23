<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WidgetType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function oldwidget_categories()
    {
        return $this->belongsToMany(WidgetCategory::class, "widget_category_widget_type");
    }

    public function widget_categories()
    {
        return $this->hasMany(WidgetCategory::class, "type_id");
    }

}
