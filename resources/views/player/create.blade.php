@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

    <div class="container">
        <br><br><br>
        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"> <h3>Registrar un nuevo jugador</h3></li>
            </ul>
            <div class="card-body">
            	@include('custom.message')
                <div class="row">
                        <div class="col-lg-12">
                            @include('flash::message')
                        </div>
                </div>
                <form method="POST" action="{{ route('store_player') }}">
                    @csrf

                    @include('player.includes.form_player')

                    <button type="submit" class="btn btn-primary">Registrar Jugador</button>
                </form>

            </div>

        </div>

        <div class="float-right"><a href="{{ route('home') }}"><small>Iniciar Sesión</small></a></div>

    </div>

@endsection
