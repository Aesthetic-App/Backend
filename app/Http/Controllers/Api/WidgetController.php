<?php

namespace App\Http\Controllers\Api;

use App\Models\Widget;
use App\Models\WidgetType;
use Illuminate\Http\Request;
use App\Models\WidgetCategory;
use App\Http\Controllers\Controller;

class WidgetController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = [];

        foreach(WidgetType::all() as $type) {
            $typeArr = [
                'name' => $type->name,
                'categories' => []
            ];

            /** @var WidgetCategory */
            foreach($type->widget_categories as $category) {
                $cat = $category->toArray();
                $cat['widgets'] = $category->widgets;
                $typeArr['categories'][] = $cat;
            }

            $types[] = $typeArr;
        }
        
        return $types;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function categoryImages(Request $request, int $id)
    {
        $widget = Widget::where('category_id', $id)->first();
        $images = [];
        foreach ($widget->media as $media) {
            $images[] = $media->getUrl();
        }

        return $images;
    }
}
