<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QuoteCategory;

class QuoteCategoryApiController extends Controller
{
    public function index()
    {
        return QuoteCategory::query()
            ->with(['quotes'])
            ->get();
    }
}
