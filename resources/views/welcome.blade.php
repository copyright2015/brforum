@extends('layouts.app')

@section('content')
    <div class="justify-content-center text-center">
        <img class="mainpic" src="{{url('img/main.png')}}" alt="">
    </div>
    <div class="container">
        <div class="card mb-4">
            <div class="card-header banana">О сайте</div>

            <div class="card-body postback">

                {!! $global->about_text !!}

            </div>
        </div>

                <div class="card mb-4">
                    <div class="card-header banana">Список досок</div>

                    <div class="card-body postback">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <table class="table table-light">
                                <thead>
                                <tr>
                                    <th scope="col">Доска</th>
                                    <th scope="col">Название</th>
                                    <th scope="col">Описание</th>
                                    <th scope="col">Постов в час</th>
                                    <th scope="col">Активных постеров</th>
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
                                        <td>{{$stats[$board->prefix]->posts_per_hour}}</td>
                                        <td>{{$stats[$board->prefix]->posters}}</td>
                                        <td>{{$stats[$board->prefix]->total_posts}}</td>
                                    </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>

                    </div>
                </div>

        <div class="card mb-4">
            <div class="card-header banana">Активные треды за сегодня</div>

            <div class="card-body postback">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <table class="table table-light">
                    <thead>
                    <tr>
                        <th scope="col">Тред</th>
                        <th scope="col">Доска</th>
                        <th scope="col">Количество постов</th>
                        <th scope="col">Последняя активность</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($boards != null)
                        @foreach($lastThreads as $thread)
                            <tr>
                                <td><a href="{{route('thread',['board_prefix'=> $thread->board->prefix, 'thread_id'=> $thread->id])}}" title="{{mb_substr($thread->message, 0, 256).'...'}}">{{mb_substr($thread->message, 0, 45).'...'}}</a></td>
                                <td><a href="{{route('board',['board_prefix' => $thread->board->prefix])}}">/{{$thread->board->prefix}}/</a></td>
                                <td>{{(isset($thread->posts)) ? count($thread->posts) : 0}}</td>
                                <td>{{$thread->bumped_at}}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

            </div>
        </div>

    </div>


@endsection
