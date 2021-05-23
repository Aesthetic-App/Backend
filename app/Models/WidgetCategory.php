<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WidgetCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type_id'];

    public function widget_types()
    {
        return $this->belongsToMany(WidgetType::class, "widget_category_widget_type");
    }

    public function widget_type()
    {
        return $this->belongsTo(WidgetType::class);
    }
}
