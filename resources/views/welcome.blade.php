@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Главная</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        Здесь будут доски и панель для логина.
                        Пример первой доски <a href="{{route('board',['board_prefix' => 'b'])}}">/b/</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
