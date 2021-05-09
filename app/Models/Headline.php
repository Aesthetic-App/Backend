<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Headline extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function categories()
    {
        return $this->belongsToMany(ThemeCategory::class, "theme_category_headline");
    }
}
