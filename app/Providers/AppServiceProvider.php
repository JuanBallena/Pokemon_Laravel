<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
/* use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str; */

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /* Builder::macro('jsonPaginate', function() {
            return $this->paginate(
                $perPage = request('page.size'),
                $colums = ['*'],
                $pageName = 'page[number]',
                $page = request('page.number')
            )->appends(request()->except('page.number'));
        });

        Builder::macro('applySorts', function() {

            if(! property_exists($this->model, 'allowedSorts')) {
                abort(500, 'Por favor agregue la propiedad 
                  pública $alowedSorts en la clase que está 
                  usando el trait HasSorts.'.get_class($this->model));
            }

            //el $this->model nos retorna "App\Pokemons"

            $sort = request('sort');
        
            if (is_null($sort)) {
                return $this; //Devolder el Builder
            }
            $sortFields = Str::of($sort)->explode(',');
        
            foreach ($sortFields as $sortField) {
                $direction = 'asc';
                
                if (Str::of($sortField)->startsWith('-')) {
                    $direction = 'desc';
                    $sortField = Str::of($sortField)->substr(1);
                }
        
                if (! collect($this->model->allowedSorts)->contains($sortField)) {
                    abort(400, 'Parámetro inválido.');
                }
        
                $this->orderBy($sortField, $direction);
            }

            return $this;
        }); */
    }

    //Debemos retornar el builder para que las funciones macro puedan ser usadas de manera consecutiva
}
