<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "firstname" => $this->firstname,
            "lastname" => $this->lastname,
            "email" => $this->email,
            "avatar" => $this->avatar,
            "country" => $this->country,
            "has_disk" => (bool) ($this->disk?->id !== null),
            "is_preminum" => (bool) $this->is_premium,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
