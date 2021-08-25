<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeCategory extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    protected $appends = ['limited_themes'];

    public function themes()
    {
        return $this->belongsToMany(Theme::class, "theme_theme_category");
    }

    public function getLimitedThemesAttribute()
    {
        return $this->themes()->limit(5)->get();
    }
}
