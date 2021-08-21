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
    public function index(Request $request)
    {
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

    public function images(Request $request, ThemeCategory $category)
    {
        $perPage = $request->per_page ?? 5;
        /** @var LengthAwarePaginator $pagination */
        $pagination = $category->media()->where("collection_name", 'images')->paginate($perPage);

        $pagination->getCollection()->transform(function($x) {
                return [
                    'normal' => $x->getFullUrl(),
                    'thumbnail' => $x->getFullUrl('thumbnail'),
                ];
        });

        return $pagination;
    }

    public function icons(Request $request, ThemeCategory $category)
    {
        $perPage = $request->per_page ?? 5;
        /** @var LengthAwarePaginator $pagination */
        $pagination = $category->media()->where("collection_name", 'icons')->paginate($perPage);

        $pagination->getCollection()->transform(function($x) {
                return [
                    'normal' => $x->getFullUrl(),
                    'thumbnail' => $x->getFullUrl('thumbnail'),
                ];
        });

        return $pagination;
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
