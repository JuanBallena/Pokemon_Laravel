<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\UsersResources;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return UsersResources::collection($users);
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        return UsersResources::make($user);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return UsersResources::make($user);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return UsersResources::make($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return UsersResources::make($user);
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return response()->json([
            "message" => "Exito"
        ]);
    }
}
