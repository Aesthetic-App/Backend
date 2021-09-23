<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WidgetCategory;
use Illuminate\Http\Request;

class WidgetCategoryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 5);
        return WidgetCategory::query()
            ->paginate($perPage);
    }


    public function widgets(Request $request, WidgetCategory $category)
    {
        
        $perPage = $request->get('per_page', 5);
        return $category->widgets()->paginate($perPage);
    }
}
