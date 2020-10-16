@extends('layouts.app_game')

@section('title', 'Sheldon')

@push('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')

    <div class="container">
        <br><br><br>
        <div class="d-flex justify-content-center"><h1>Juego de sheldon</h1></div>
        <div class="d-flex justify-content-center"><small><a href="" data-toggle="modal" data-target="#exampleModal">Reglas del juego sheldon</a></small></div>
        <br>
        <div class="row">
            <div class="col-lg-4">
                <h3>Los mejores jugadores</h3>
                @if(!is_null($six_best_players) && sizeof($six_best_players))
                    <ul class="list-group" id="list-best-players">
                        @foreach($six_best_players as $best_player)
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{$best_player->player_name}}
                            <span class="badge badge-primary badge-pill">{{$best_player->score}}</span>
                          </li>
                        @endforeach
                    </ul>
                @else
                <h6>No existen jugadores</h6>
                @endif
            </div>
            <div class="col-lg-8">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-4 col-form-label">Puntuacion de {{$player->player_name}}:</label>
                    <div class="col-sm-8">
                      <input type="text" id="score-player" readonly class="form-control-plaintext" id="staticEmail" value="{{ (!is_null($score_of_player)) ? $score_of_player->score : 0 }}">
                    </div>
                </div>
                <h4> Seleccione una de las opciones</h4>
                <div class="row">
                    <div></div>
                    @for($i = 0; $i < sizeof($options_sheldon); $i++)
                        <div class="col-lg-4">
                            <a class="btn btn-lg px-5 btn-primary button-sheldon" data-id="{{$options_sheldon[$i]}}" href="#" role="button">{{$options_sheldon[$i]}}</a>
                            <br><br>
                        </div>

                    @endfor

                </div>

                <input type="hidden" id="player_id" name="player_id" value="{{$player->id}}">

                <input type="hidden" id="game_id" name="game_id" value="1">
            </div>
        </div>


    </div>

    @include('games.include.modal')
    @include('games.include.modal_rules')

@endsection


@push('scripts')
    <script src="/js/create_register_sheldon.js"></script>
@endpush
