<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TranslationApiController extends Controller
{
    public function index(Request $request)
        {
            $locale = 'en';

            if ($request->hasHeader('X-Locale')) {
                $locale = $request->header('X-Locale');
            }

            return trans('mobile', [], $locale);
        }
}
