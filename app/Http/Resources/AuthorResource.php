<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,  // It's good practice to include ID in resources
            'name' => $this->name,
            'birthday' => $this->birthday,
            'nationality' => $this->nationality,
        ];
    }
}