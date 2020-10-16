<?php

namespace App\Http\Controllers;

use App\Models\GameScore;
use App\Models\Player;
use App\Models\SheldonRule;
use Illuminate\Http\Request;

class SheldonController extends Controller
{
    /*Funcion que retorna la vista del juego Sheldon*/
    public function home($player_name)
    {
        /*validacion si existe un jugador con el nombre que viene en la ruta permita ingresar al juego
        caso contrario redirigir a la ruta home que es el login de un jugador*/
        try {
            $player          = Player::where('player_name', str_replace("_", " ", $player_name))->firstOrFail();
            $game_id         = 1;
            $options_sheldon = $this->optionSheldon();
            $score_of_player = $this->getScorePlayerGame($game_id, $player->id);

            //esta consulta ORM esta declarada en el modelo GameScore la cual retorna los 6 mejores jugadores
            $six_best_players = GameScore::bestPlayerSheldon();
            return view('games.sheldon', compact('player', 'options_sheldon', 'score_of_player', 'six_best_players'));
        } catch (\Exception $e) {
            flash('Estimado <strong>' . str_replace("_", " ", $player_name) . '</strong> primero debe registrar un jugador')->error();
            return redirect()->route('home');
        }

    }

    /*Funcion que registra el score de una partida del juego por ajax*/
    public function storeMatchSheldon(Request $request)
    {
        $rule_sheldon    = $this->getRuleSheldon($request);
        $score_of_player = $this->getScorePlayerGame($request->game_id, $request->player_id);

        $this->storeScoreSheldon($rule_sheldon, $score_of_player, $request);

        $score_of_player  = $this->getScorePlayerGame($request->game_id, $request->player_id);
        $six_best_players = GameScore::bestPlayerSheldon();

        return response()->json(['code' => 200, 'message' => $rule_sheldon['message'], 'data' => ['score_player' => $score_of_player, 'six_best_players' => $six_best_players, 'rule_sheldon' => $rule_sheldon]], 200);
    }

    /*Esta funcion guarda un nuevo score o actualiza un score existente en el caso de que el jugador gane la partida*/
    public function storeScoreSheldon($rule_sheldon, $score_of_player, $request)
    {
        if (is_null($score_of_player) && $rule_sheldon['validation_win_match']) {
            $score_player            = new GameScore;
            $score_player->score     = 1;
            $score_player->game_id   = $request->game_id;
            $score_player->player_id = $request->player_id;
            $score_player->save();
        }

        if (!is_null($score_of_player) && $rule_sheldon['validation_win_match']) {
            $score_of_player->score = $score_of_player->score + 1;
            $score_of_player->save();
        }
    }

    /*funcion que retorna el score del jugador*/

    public function getScorePlayerGame($game_id, $player_id)
    {
        $score_of_player = GameScore::where('game_id', $game_id)->where('player_id', $player_id)->first();

        return $score_of_player;
    }

    /*Funcion que valida si el jugador gana una partida de sheldon*/
    public function getRuleSheldon($request)
    {
        //validacion si la partida es empate
        if ($request->option_1 == $request->option_2) {
            return ['validation_win_match' => false, 'message' => 'Es un Empate', 'rule_sheldon' => null];
        }

        //validacion si el jugador gana o pierde la partida mediante una consulta ORM a la BD
        $rule_sheldon = SheldonRule::where('option_1', $request->option_1)->where('option_2', $request->option_2)->first();

        //si existe el registro en la BD el jugador gana la partida
        if (!is_null($rule_sheldon)) {
            return ['validation_win_match' => true, 'message' => 'Ganaste la partida', 'rule_sheldon' => $rule_sheldon];
        } else {
            return ['validation_win_match' => false, 'message' => 'Perdiste la partida', 'rule_sheldon' => null];
        }
    }

    //funcion que retorna los sujetos que interactuan en el juego
    //Se la realiza para no duplicar codigo html en la view del juego
    public function optionSheldon()
    {
        return ['tijeras', 'papel', 'roca', 'lagarto', 'Spock'];
    }
}
