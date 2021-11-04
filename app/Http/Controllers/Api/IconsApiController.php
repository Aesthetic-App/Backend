<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Icon;
use Illuminate\Http\Request;

class IconsApiController extends Controller
{
    public function update(Request $request, int $iconId){
        return Icon::query()
            ->where("id", $iconId)
            ->update($request->only(["name", "original_id"]));
    }
}
