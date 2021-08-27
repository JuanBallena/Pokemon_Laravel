<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pokemon;
use App\Http\Resources\PokemonsResources;
use App\Http\Resources\PokemonCollection;
use App\Http\Resources\TestResource;
use App\Http\Controllers\ImageController;

class PokemonController extends Controller
{
    public function index()
    {        
        $pokemons = Pokemon::applyFilters()->applySorts()->paginate(2);//jsonPaginate();
        // return response()->json([
        //     "responseCode" => 200,
        //     "responseMessage" => "EXITO",
        //     "data" => PokemonsResources::collection($pokemons)
        // ]);
        return PokemonCollection::make($pokemons);
        //urldecode($link);
    }
    /*->where('name', 'LIKE', "%".request('filter.name')."%");*/

    public function store(Request $request)
    {
        $params = json_decode($request->data, true);

        $pokemon = Pokemon::create($params);
        $file = $request->file('avatar');
        if ($file) {
            $array = ImageController::saveImage($file);
            $pokemon->update(['url_image' => $array['url_image']]);
            $pokemon->update(['public_id_image' => $array['public_id_image']]);
        }
        return PokemonsResources::make($pokemon);
    }

    public function show($id)
    {
        $pokemon = Pokemon::findOrFail($id);
        return PokemonsResources::make($pokemon);
    }

    public function edit($id)
    {
        $pokemon = Pokemon::findOrFail($id);
        return PokemonsResources::make($pokemon);
    }

    public function update(Request $request, $id)
    {
        $pokemon = Pokemon::findOrFail($id);
        $params = json_decode($request->data, true);
        $pokemon->update($params);

        $file = $request->file('avatar');
        if ($file) {
            $array = ImageController::saveImage($file);
            $pokemon->update(['url_image' => $array['url_image']]);
            $pokemon->update(['public_id_image' => $array['public_id_image']]);
        }
        return PokemonsResources::make($pokemon);
    }

    public function destroy($id)
    {
        $pokemon = Pokemon::findOrFail($id);
        if ($pokemon->url_image) {
            ImageController::deleteImage($pokemon->public_id_image);
        }
        $pokemon->delete();
        return response()->json([
            "message" => "El pokemon fue eliminado."
        ]);
    }

    public function deleteImage($id)
    {
        $pokemon = Pokemon::findOrFail($id);
        ImageController::deleteImage($pokemon->public_id_image);
        $pokemon->update(['url_image' => null]);
        $pokemon->update(['public_id_image' => null]);
        return response()->json([
            "message" => "La foto fue eliminada."
        ]);
    }
}
