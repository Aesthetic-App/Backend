<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ThemeCategory;
use Illuminate\Http\Request;

class ThemeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ((bool)$request->get('without_pagination', false) === true) {
            return ThemeCategory::all();
        }

        $perPage = $request->get('per_page', 5);
        return ThemeCategory::query()
            ->paginate($perPage);
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

    public function themes(Request $request, ThemeCategory $category)
    {
        if ((bool)$request->get('without_pagination', false) === true) {
            return $category->themes;
        }
        $perPage = $request->get('per_page', 5);
        return $category->themes()->paginate($perPage);
    }
}
