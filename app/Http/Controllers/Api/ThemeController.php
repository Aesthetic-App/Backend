<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 5);
        if ((bool)$request->get('without_pagination', false) === true) {
            return Theme::all();
        }

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

        if ((bool)$request->get('without_pagination', false) === true) {
            $imagesCollection = $theme->media()
                ->where("collection_name", 'images')
                ->get();
            return $this->transformImagesCollection($imagesCollection)->toArray();
        }

        /** @var LengthAwarePaginator $pagination */
        $pagination = $theme->media()->where("collection_name", 'images')->paginate($perPage);
        $this->transformImagesCollection($pagination->getCollection());
        return $pagination;
    }

    public function iconsv2(Request $request, Theme $theme)
    {
        return $theme->icons()->where("type", "normal")->get();
    }

    public function icons(Request $request, Theme $theme)
    {
        $perPage = $request->per_page ?? 5;
        if ((bool)$request->get('without_pagination', false) === true) {
            $imagesCollection = $theme->media()
                ->where("collection_name", 'icons')
                ->get();
            return $this->transformImagesCollection($imagesCollection)->toArray();
        }

        /** @var LengthAwarePaginator $pagination */
        $pagination = $theme->media()->where("collection_name", 'icons')->paginate($perPage);
        $this->transformImagesCollection($pagination->getCollection());
        return $pagination;
    }

    private function transformImagesCollection($collection) {
        return $collection->transform(function($x) {
                return [
                    'normal' => $x->getFullUrl(),
                    'thumbnail' => $x->getFullUrl('thumbnail'),
                ];
        });
    }
}
