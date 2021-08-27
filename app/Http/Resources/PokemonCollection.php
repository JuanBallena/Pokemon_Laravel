<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PokemonCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    //public $collects = PokemonsResource::class; 

    public function toArray($request)
    {
        return [
            'data' => PokemonsResources::collection($this->collection),
            'links' => [
                'self' => route('pokemons.index')
            ]
        ];
    }
}
