<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PokemonsResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "type" => $this->type->name,
            "type" => [
                "id" => $this->type->id,
                "name" => $this->type->name
            ],
            "url_image" => $this->url_image,
            "public_id_image" => $this->public_id_image,
            // "trainer" => $this->trainer->name,
            "trainer" => [
                "id" => $this->trainer->id,
                "name" => $this->trainer->name
            ],
            "created_at" => $this->created_at->format('d-m-Y'),
            // "request" => $request
        ];
    }
}
