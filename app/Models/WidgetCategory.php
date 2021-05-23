<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WidgetCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type_id'];

    public function widget()
    {
        return $this->belongsTo(WidgetType::class, 'type_id');
    }
}
