<?php

namespace App\Http\Controllers\Api;

use App\Models\Media;
use Illuminate\Http\Request;
use App\Models\WallpaperCategory;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class WallpaperCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 5);
        return WallpaperCategory::query()
            ->paginate($perPage);

        // $categories = WallpaperCategory::all();
        // $resp = [];
        // foreach($categories as $category) {
        //     $resp[] = [
        //         'id' => $category->id,
        //         'title' => $category->title,
        //         'is_premium' => $category->is_premium,
        //         'media' => Media::paginate($category, 'images'),
        //     ];
        // }
        // return $resp;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function images(Request $request, WallpaperCategory $category)
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
