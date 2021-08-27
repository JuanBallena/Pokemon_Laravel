<?php

namespace App;
use App\User;
use App\Pokemon;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $fillable = [
        'user_id', 
        'name', 
        'country', 
        'url_image', 
        'public_id_image', 
        'stars'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'name' => 'string',
        'country' => 'string',
        'url_image' => 'string', 
        'public_id_image' => 'string', 
        'stars' => 'integer'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function pokemons() {
        return $this->hasMany(Pokemon::class);
    }
}
