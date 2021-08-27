<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TrainersResources extends JsonResource
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
            "country" => $this->country,
            "url_image" => $this->url_image,
            "stars" => $this->stars,
            //"pokemons" => $this->pokemons,
            "user" => [
                "name" => $this->user->name,
                "role" => [
                    "id" => $this->user->role->id,
                    "name" => $this->user->role->name
                ]
            ],
        ];
    }
}
