<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quote;

class QuoteApiController extends Controller
{
    public function index()
    {
        return Quote::all();
    }
}
