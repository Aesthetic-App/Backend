<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 5);
        return Theme::query()
            ->paginate($perPage);
    }   

    public function show(Theme $theme)
    {
        return $theme->load(['categories']);
    }

        public function images(Request $request, Theme $theme)
    {
        $perPage = $request->per_page ?? 5;
        /** @var LengthAwarePaginator $pagination */
        $pagination = $theme->media()->where("collection_name", 'images')->paginate($perPage);

        $pagination->getCollection()->transform(function($x) {
                return [
                    'normal' => $x->getFullUrl(),
                    'thumbnail' => $x->getFullUrl('thumbnail'),
                ];
        });

        return $pagination;
    }

    public function icons(Request $request, Theme $theme)
    {
        $perPage = $request->per_page ?? 5;
        /** @var LengthAwarePaginator $pagination */
        $pagination = $theme->media()->where("collection_name", 'icons')->paginate($perPage);

        $pagination->getCollection()->transform(function($x) {
                return [
                    'normal' => $x->getFullUrl(),
                    'thumbnail' => $x->getFullUrl('thumbnail'),
                ];
        });

        return $pagination;
    }
}
