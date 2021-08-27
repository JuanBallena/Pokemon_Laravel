<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    protected $fillable = [
        'name', 
        'display_name',
    ];

    public function user() {
        return $this->hasMany(User::class);
    }
}
