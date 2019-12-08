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

                        Список досок.

                            <table class="table table-dark">
                                <thead>
                                <tr>
                                    <th scope="col">Доска</th>
                                    <th scope="col">Название</th>
                                    <th scope="col">Описание</th>
                                    <th scope="col">Всего постов</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($boards != null)
                                    @foreach($boards as $board)
                                    <tr>
                                        <td><a href="{{route('board',['board_prefix' => $board->prefix])}}">/{{$board->prefix}}/</a></td>
                                        <td>{{$board->name}}</td>
                                        <td>{{$board->description}}</td>
                                        <td>{{$postCount}}</td>
                                    </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
