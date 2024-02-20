<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterMessageRequest;
use App\Http\Resources\FilterMessageResource;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use OpenAI;

class SpamFilterController extends Controller
{
    public function filterMessage(FilterMessageRequest $request)
    {
        $attributes = $request->validated();
        $cacheName = Str::lower(Str::remove(' ', $attributes['body']));

        $result = Cache::remember('spam_'.$cacheName, 10080, function () use ($attributes) {
            $client = OpenAI::client(config('services.open-ai.api-key'));

            $response = $client->chat()->create([
                'model' => 'gpt-3.5-turbo-1106',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are a moderator that manages chat, comment sections and forum who always responds using JSON.'],
                    [
                        'role' => 'user',
                        'content' => <<< EOT
                            Please inspect the following text and determine if it is spam.

                            {$attributes['body']}

                            In more details with score explanation output in json. JSON that contains is_spam, reasons with score, total_score and explanation.
                        EOT,
                    ],
                ],
                'response_format' => ['type' => 'json_object'],
            ]);

            return $response;
        });

        return FilterMessageResource::collection($result->choices);
    }
}
