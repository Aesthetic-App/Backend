<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Headline;
use App\Models\Media;
use App\Models\ThemeCategory;
use Illuminate\Http\Request;

class ThemeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = ThemeCategory::all();
        $resp = [];
        foreach($cats as $category) {
            $resp[] = [
                'id' => $category->id,
                'title' => $category->title,
                'is_premium' => $category->is_premium,
                'cover_image_url' => $category->cover_image_url
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
     * @param  \App\Models\ThemeCategory  $themeCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ThemeCategory $category)
    {
       return [
            'id' => $category->id,
            'title' => $category->title,
            'is_premium' => $category->is_premium,
            'cover_image_url' => $category->cover_image_url
        ];
    }

    public function images(Request $request, ThemeCategory $category)
    {
        $media = Media::paginate($category, 'images');
        return [
            'media' => $media,
            'id' => $category->id,
            'title' => $category->title,
            'is_premium' => $category->is_premium,
            'cover_image_url' => $category->cover_image_url
        ];
    }

    public function icons(Request $request, ThemeCategory $category)
    {
        $media = Media::paginate($category, 'icons');
        return [
            'media' => $media,
            'id' => $category->id,
            'title' => $category->title,
            'is_premium' => $category->is_premium,
            'cover_image_url' => $category->cover_image_url
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ThemeCategory  $themeCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ThemeCategory $themeCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ThemeCategory  $themeCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ThemeCategory $themeCategory)
    {
        //
    }
}
