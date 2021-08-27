<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use App\Http\Resources\TypesResources;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::all();
        return TypesResources::collection($types);
    }
}
