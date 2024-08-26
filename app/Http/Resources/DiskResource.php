<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "serial_number" => $this->serial_number,
            "name" => $this->name,
            "angle" => $this->angle,
            "battery" => $this->battery,
        ];
    }
}
