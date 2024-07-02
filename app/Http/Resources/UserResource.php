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
            "name" => $this->name,
            "email" => $this->email,
            "avatar" => $this->avatar,
            "is_preminum" => (bool) $this->is_premium,
            "is_admin" => (bool) $this->is_admin,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
