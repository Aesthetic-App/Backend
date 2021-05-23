<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Headline;
use App\Models\Widget;
use Illuminate\Http\Request;

class WidgetController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $widgets = [];
        foreach(Widget::all() as $widget) {
            $typeName = $widget->widget_type->name;
            if(!isset($widgets[$typeName])) {
                $widgets[$typeName] = [
                    'name' => $typeName,
                    'categories' => [],
                ];
            }
            
            $widgets[$typeName]['categories'][] = [
                'id' => $widget->widget_category->id,
                'name' => $widget->widget_category->name,
                'image' =>  $widget->media()->first() ? $widget->media()->first()->getUrl() : null
            ];
            
        };
        return $widgets;
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Headline  $headline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Headline $headline)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Headline  $headline
     * @return \Illuminate\Http\Response
     */
    public function destroy(Headline $headline)
    {
        //
    }
}
