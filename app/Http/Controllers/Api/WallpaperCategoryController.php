<?php

namespace App\Http\Controllers\Api;

use App\Models\Media;
use Illuminate\Http\Request;
use App\Models\WallpaperCategory;
use App\Http\Controllers\Controller;

class WallpaperCategoryController extends Controller
{
    public function images(Request $request, WallpaperCategory $category)
    {
        $media = Media::paginate($category, 'images');
        return [
            'media' => $media,
            'id' => $category->id,
            'title' => $category->title,
            'is_premium' => $category->is_premium,
        ];
    }

    public function icons(Request $request, WallpaperCategory $category)
    {
        $media = Media::paginate($category, 'icons');
        return [
            'media' => $media,
            'id' => $category->id,
            'title' => $category->title,
            'is_premium' => $category->is_premium,
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = WallpaperCategory::all();
        $resp = [];
        foreach($categories as $category) {
            $resp[] = [
                'id' => $category->id,
                'title' => $category->title,
                'is_premium' => $category->is_premium,
                'media' => Media::paginate($category, 'images'),
            ];
        }
        return $resp;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WallpaperCategory  $wallpaperCategory
     * @return \Illuminate\Http\Response
     */
    public function show(WallpaperCategory $category)
    {
        return [
            'id' => $category->id,
            'title' => $category->title,
            'media' => Media::paginate($category, 'images'),
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WallpaperCategory  $wallpaperCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WallpaperCategory $wallpaperCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WallpaperCategory  $wallpaperCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(WallpaperCategory $wallpaperCategory)
    {
        //
    }
}
