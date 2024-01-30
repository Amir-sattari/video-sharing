<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'length' => $this->length,
            'path' => $this->path,
            'thumbnail' => $this->thumbnail,
            'description' => $this->description,
            'category' => $this->category->name,
            'owner' => $this->user->name,
        ];
    }
}
