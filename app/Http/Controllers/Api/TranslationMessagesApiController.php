<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TranslationMessage;
use Illuminate\Http\Request;

class TranslationMessagesApiController extends Controller
{
    public function index() {
        return TranslationMessage::all();
    }
}
