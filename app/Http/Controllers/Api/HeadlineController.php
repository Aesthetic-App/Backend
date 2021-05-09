<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Headline;
use Illuminate\Http\Request;

class HeadlineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
