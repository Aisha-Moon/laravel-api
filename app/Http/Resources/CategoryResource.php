<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;  // Add this line
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\illuminate\Contracts\Support\Arrayable\|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
