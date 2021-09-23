<?php

namespace Aesthetic\Translation\Http;

use App\Models\TranslationMessage;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TranslationEditorController extends Controller
{
    use ValidatesRequests;

    public function index(Request $request)
    {
        $config = config('translation-editor');
        $locales = $config['locales'];
        $response = [
            'locales' => $locales,
            'messages' => TranslationMessage::all(),
        ];

        return $response;
    }

    public function add(Request $request)
    {
        TranslationMessage::query()
            ->create($request->all());

        return $this->index($request);
    }

    /**
     * @param Request $request
     *
     * @return void
     */
    public function save(Request $request)
    {
        $messages = $request->get('data');
        TranslationMessage::query()
            ->truncate();
        foreach ($messages as $message) {
         TranslationMessage::query()
             ->updateOrCreate([
                 "key" => $message['key']
             ], [
                 'messages' => $message['messages']
             ]);
        }
    }
}
