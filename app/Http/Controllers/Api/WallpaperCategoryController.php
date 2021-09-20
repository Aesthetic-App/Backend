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
}
