<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TranslationMessage;

class TranslationMessagesApiController extends Controller
{
    public function locale(string $locale) {
        return TranslationMessage::all()
            ->map(fn($messageModel) => [
                'key' => $messageModel->key,
                'value' => $messageModel->messages[$locale] ?? ($messageModel->messages['en'] ?? '')
            ]);
    }
}
