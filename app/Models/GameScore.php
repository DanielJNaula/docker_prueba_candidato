<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameScore extends Model
{
    protected $table = 'game_scores';

    protected $fillable = [
        'score',
        'game_id',
        'player_id',
    ];

    /*Relacion de uno a muchos entre la tabla players y game_scores*/
    public function player()
    {
        return $this->belongsTo('App\Models\Player');
    }

    /*Relacion de uno a muchos entre la tabla games y game_scores*/
    public function game()
    {
        return $this->belongsTo('App\Models\Game');
    }

    /*Funcion que retorn los 6 jugadores mejores*/
    public static function bestPlayerSheldon()
    {
        return GameScore::join('players', 'players.id', '=', 'game_scores.player_id')
            ->where('game_scores.game_id', 1)
            ->select('players.player_name', 'game_scores.score')
            ->orderBy('game_scores.score', 'DESC')
            ->take(6)
            ->get();
    }

}
