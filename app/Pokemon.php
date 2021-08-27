<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Trainer;
use App\Type;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
//use App\Traits\HasSorts;

class Pokemon extends Model
{
    //use HasSorts;

    public $allowedSorts = ['name','created_at'];

    protected $fillable = [
        'name', 
        'type_id', 
        'url_image', 
        'public_id_image', 
        'trainer_id'
    ];

    protected $table = 'pokemons';

    public function trainer() {
        return $this->belongsTo(Trainer::class);
    }

    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function scopeName(Builder $query, $value)
    {
        $query->where('name', 'LIKE', "%{$value}%");
    }

    public function scopeYear(Builder $query, $value)
    {
        $query->whereYear('created_at', $value);
    }

    public function scopeMonth(Builder $query, $value)
    {
        $query->whereMonth('created_at', $value);
    }

    public function scopeSearch(Builder $query, $values)
    {
        foreach(Str::of($values)->explode(' ') as $value) {
            $query->orWhere('name', 'LIKE', "%{$value}%")
                ->orWhere('type_id', 'LIKE', "%{$value}%");
        }
    }

    /* public function scopeApplySorts(Builder $query, $sort) {

        if (is_null($sort)) {
            return;
        }
        $sortFields = Str::of($sort)->explode(',');

        foreach ($sortFields as $sortField) {
            $direction = 'asc';
            if (Str::of($sortField)->startsWith('-')) {
                $direction = 'desc';
                $sortField = Str::of($sortField)->substr(1);
            }

            if (! collect($this->allowedSorts)->contains($sortField)) {
                abort(400, 'Parámetro inválido.');
            }
            $query->orderBy($sortField, $direction);
        }
    } */
}
