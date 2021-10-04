<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TranslationMessage;
use Illuminate\Http\Request;

class TranslationMessagesApiController extends Controller
{
    public function locale(string $locale) {
        $messages = [];
        foreach (TranslationMessage::all() as $messageModel) {

            $message = $messageModel->messages[$locale] ?? ($messageModel->messages['en'] ?? '');
            $messages[$messageModel->key] = $message;
        }

        return $messages;
    }
}
