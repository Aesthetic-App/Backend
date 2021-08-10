<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Headline;
use App\Models\ThemeCategory;
use Illuminate\Http\Request;

class HeadlineController extends Controller
{

    private function headline($headline, $limit = null)
    {
            $categories = $headline->categories();
            if ($limit) $categories->limit($limit);
            $categories = $categories->get();
            $catArray = [];
            /** @var ThemeCategory $category */
            foreach($categories as $category) {
                $catArray[] = [
                    "id" => $category->id,
                    "title" => $category->title,
                    "is_premium" => $category->is_premium,
                    "cover_image_url" => $category->cover_image_url,
                ];
            }
            return ["id" => $headline->id, "title" => $headline->title, "categories" => $catArray];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headlines = [];
        foreach(Headline::all() as $headline) {
            $headlines[] = $this->headline($headline, 20);
        }
        return $headlines;
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
     * @param  \App\Models\Headline  $headline
     * @return \Illuminate\Http\Response
     */
    public function show(Headline $headline)
    {
        return $this->headline($headline);
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
