@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mb-4">
            <div class="card-header banana">Информация о пользователе</div>

            <div class="card-body postback">
                <strong>Никнейм:</strong> {{Auth::user()->name}}
                <br>
                <strong>Почта:</strong> {{Auth::user()->email}}
                <br>
                <strong>Роли:</strong> @foreach(Auth::user()->roles()->get() as $role)| {{$role->name}} @endforeach

            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header banana">Изменение данных</div>
            <div class="card-body postback">
                <a href="{{url('/password/reset')}}" >Сменить пароль</a>
            </div>
        </div>
    </div>
@endsection
