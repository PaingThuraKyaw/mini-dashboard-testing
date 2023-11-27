<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            "name" => $this->name ,
            "phNumber" => $this->phNumber,
            "company" => $this->company,
            "position" => $this->position,
            "age" => $this->age,
            "created_at" => $this->created_at->format("d M Y"),
        ];
    }
}
