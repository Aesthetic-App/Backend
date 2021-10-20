<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WallpaperCategory;

class WallpaperCategoryWallpapersApiController extends Controller
{
    public function index(WallpaperCategory $category)
    {
        return $category->wallpapers;
    }
}
