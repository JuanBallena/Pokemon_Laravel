<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Http\Resources\RolesResources;

class RoleController extends Controller
{
    public function index()
    {
        //EXMAPLE PAGINATE

        //URL: api?page[size]=2&page[number]=3

        $size = request('page.size');
        $number = request('page.number');

        //dd($size);
        //EL METODO PAGINATE DE QUERY BUILDER RECIBE VARIOS PARAMETROS

        $roles = Role::paginate(
            $perPage = request('page.size'),
            $colums = ['*'],
            $pageName = 'page[number]', //por default 'page'
            $page = request('page.number')
        )->appends();


        //$roles = Role::all();
        return RolesResources::collection($roles);
    }
}
