<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table = 'players';

    protected $fillable = [
        'player_name',
    ];

    /*Relacion de uno a muchos entre la tabla players y game_scores*/
    public function gameScore()
    {
        return $this->hasMany('App\Models\GameScore');
    }
}
