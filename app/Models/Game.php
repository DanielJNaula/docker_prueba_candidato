<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'games';

    protected $fillable = [
        'game_name',
    ];

    /*Relacion de uno a muchos entre la tabla games y game_scores*/

    public function gameScore()
    {
        return $this->hasMany('App\Models\GameScore');
    }
}
