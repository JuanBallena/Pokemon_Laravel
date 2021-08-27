<?php

namespace App;
use App\Pokemon;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'name'
    ];

    public function pokemon() {
        return $this->hasOne(Pokemon::class);
    }
}
