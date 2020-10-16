@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

    <div class="container">
        <br><br><br>
        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"> <h3>Inicia sesión</h3></li>
            </ul>
            <div class="card-body">
                <div class="row">
                        <div class="col-lg-12">
                            @include('flash::message')
                        </div>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    @include('player.includes.form_player')

                    <button type="submit" class="btn btn-primary">Ingresar</button>
                </form>

            </div>
        </div>
        <div class="float-right"><a href="{{ route('create_player') }}"><small>¿No tienes un nombre de jugador? Registrar un nuevo jugador</small></a></div>

    </div>

@endsection
