<?php

namespace App\JsonApi;

//use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class JsonApiBuilder {

  public function jsonPaginate()
  {
    return function() {
      return $this->paginate(
        $perPage = request('page.size'),
        $colums = ['*'],
        $pageName = 'page[number]',
        $page = request('page.number')
      )->appends(request()->except('page.number'));
    };
  }

  public function applySorts()
  {
    return function() {
      if(! property_exists($this->model, 'allowedSorts')) {
        abort(500, 'Por favor agregue la propiedad 
          pública $alowedSorts en la clase que está 
          usando el trait HasSorts.');
      }

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
    };
  }

  public function applyFilters()
  {
    return function() {
      foreach(request('filter', []) as $filter => $value) {

        if (! $this->hasNamedScope($filter)) {
          abort(400, "El filtro '{$filter}' no está permitido.");
        }
        $this->{$filter}($value);

        /* //Solucion 2 al if
        $scope = "scope".ucfirst($filter);

        if (! method_exists($this->model, $scope)) {
          abort(400, "El filtro '{$filter}' no está permitido.");
        } */
        
        /* if($filter === 'year') {
            $this->whereYear('created_at', $value);
        } elseif($filter === 'month') {
            $this->whereMonth('created_at', $value);
        } else {
            $this->where($filter, 'LIKE', "%{$value}%");
        } */
      }

      return $this;
    };
  }
}