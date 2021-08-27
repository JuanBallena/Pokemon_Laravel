<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trainer;
use App\Http\Resources\TrainersResources;
use Illuminate\Support\Str;

class TrainerController extends Controller
{
    public function index()
    {
        //example get with sort one field
        /*$direction = 'asc';
        $sortField = request('sort');

        if (Str::of($sortField)->startsWith('-')) {
            $direction = 'desc';
            $sortField = Str::of($sortField)->substr(1);
        }

        $trainers = Trainer::orderBy($sortField, $direction)->get();*/

        
        // example get with sort various fields
        
        $sortFields = Str::of(request('sort'))->explode(',');
        $trainerQuery = Trainer::query();
        
        foreach ($sortFields as $sortField) {
            $direction = 'asc';
            if (Str::of($sortField)->startsWith('-')) {
                $direction = 'desc';
                $sortField = Str::of($sortField)->substr(1);
            }

            $trainerQuery->orderBy($sortField, $direction);
        }
        
        // \DB::listen(function($db) {
        //     dd($db->sql);
        // });

        $trainers = $trainerQuery->get();


        // $trainers = Trainer::paginate(6);
        return TrainersResources::collection($trainers);
    }

    public function store(Request $request)
    {
        $trainer = Trainer::create($request->all());
        return TrainersResources::make($trainer);
    }

    public function show($id)
    {
        $trainer = Trainer::findOrFail($id);
        return TrainersResources::make($trainer);
    }

    public function edit($id)
    {
        $trainer = Trainer::findOrFail($id);
        return TrainersResources::make($trainer);
    }

    public function update(Request $request, $id)
    {
        $trainer = Trainer::findOrFail($id);
        $trainer->update($request->all());
        return TrainersResources::make($trainer);
    }

    public function destroy($id)
    {
        Trainer::findOrFail($id)->delete();
        return response()->json([
            "message" => "Exito"
        ]);
    }
}
