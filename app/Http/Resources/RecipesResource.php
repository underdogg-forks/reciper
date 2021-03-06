<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecipesResource extends JsonResource
{
    // Transform the resource into an array.
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->resource->getTitle(),
            'intro' => $this->resource->getIntro(),
            'time' => $this->time,
            'image' => $this->image,
        ];
    }
}
