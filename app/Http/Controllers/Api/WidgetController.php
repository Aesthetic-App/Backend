<?php

namespace App\Http\Controllers\Api;

use App\Models\Widget;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WidgetController extends Controller
{
    public function index()
    {
        return Widget::all();
    }

    public function categoryImages(Request $request, int $id): array
    {
        $widget = Widget::where('category_id', $id)->first();
        $images = [];
        foreach ($widget->media as $media) {
            $images[] = $media->getUrl();
        }

        return $images;
    }
}
