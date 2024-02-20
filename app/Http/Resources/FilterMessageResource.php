<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilterMessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $content = json_decode($this->message->content, true);

        return [
            'is_spam' => $content['is_spam'] ?? '',
            'reasons' => $content['reasons'] ?? '',
            'total_score' => $content['total_score'] ?? '',
            'explanation' => $content['explanation'] ?? '',
        ];
    }
}
