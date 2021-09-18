<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OptimistDigital\NovaSettings\Models\Settings;

class SettingsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $responseFormat = $request->get('response_format', 'array');
        $settings = Settings::query()->get()->toArray();

        if ($responseFormat === 'dictionary') {
            $dict = [];
            foreach($settings as $settings) {
                $dict[$settings['key']] = $settings['value'];
            }

            return $dict;
        } 

        return $settings;
    }
}
