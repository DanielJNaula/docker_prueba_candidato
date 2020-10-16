<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerRequest;
use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /*Funcion que retorn a la vista principal del app web*/
    public function home()
    {
        return view('welcome');
    }

    /*funcion que retorna la vista del registro de un nuevo jugador*/
    public function createPlayer()
    {
        return view('player.create');
    }

    /*Esta funcion guarda un nuevo jugador con validaciones en form request Laravel y redirecciona a la ruta del juego Sheldon*/
    public function storePlayer(PlayerRequest $request)
    {

        $player = Player::create($request->all());

        return redirect()->route('home_sheldon', ['player_name' => str_replace(" ", "_", $player->player_name)]);

    }

    /*Esta funcion busca al jugador y redirecciona a la ruta del juego Sheldon*/
    public function login(Request $request)
    {

        $player = Player::where('player_name', $request->player_name)->first();

        if (is_null($player)) {
            flash('El jugador <strong>' . $request->player_name . '</strong> no se ha encontrado')->error();
            return redirect()->route('home');
        }

        return redirect()->route('home_sheldon', ['player_name' => str_replace(" ", "_", $player->player_name)]);

    }

}
