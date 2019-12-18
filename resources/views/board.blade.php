@extends('layouts.app')



@section('content')
    @include('layouts.boardtop');
    <div class="container mb-4">
        <form method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="theme">Тема</label>
                <input type="text" class="form-control @error('theme') is-invalid @enderror" id="theme" name="theme" placeholder="Тема">
                @error('theme')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="message">Сообщение</label>
                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="3"></textarea>
                @error('message')
                <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div>
                <input type="file" id="img" name="imgs[]" multiple class="mb-2 form-control @error('img') is-invalid @enderror">
                @error('img')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-custom ">Ответить</button>
        </form>
    </div>

@if(count($threads) > 0)
    @foreach($threads as $thread)
        <div class="card">
            <div class="card-header banana">
                <h6 class="my-0 font-weight-normal"><b>{{$board->default_user_name}}</b> || <b>{{$thread->theme}}</b> | {{$thread->created_at}} | <a href="#" name="">{{$thread->id}}</a> | <span> <a href="{{route('thread',['board_prefix'=>$board->prefix,'thread_id'=>$thread->id])}}">Ответить</a></span> </h6>
            </div>
            <div class="card-body oppostback">
                @if( $thread->img != null)
                    @foreach($thread->img as $img)
                        <a href="{{url($img)}}" target="_blank">
                            <img alt="" class="thumb" src="{{url(substr_replace($img ,'s', -4).substr_replace($img, '' ,'s', -4))}}" title="[Click] открыть по центру, [Ctrl+Click] в посте">
                        </a>
                    @endforeach
                @endif
                <span>{{$thread->message}}</span>
                <br>
                <span> <a href="{{route('thread',['board_prefix'=>$board->prefix,'thread_id'=>$thread->id])}}">Ответить</a></span>
                    @foreach($thread->posts as $post)
                        <div class="card mb-4">
                            <div class="card-header banana">
                                <h6 class="my-0 font-weight-normal"><b>{{$board->default_user_name}}</b> || <b>{{$post->theme}}</b> | {{$post->created_at}} | <a href="#{{$post->id}}" name="{{$post->id}}">{{$post->id}}</a></h6>
                            </div>
                            <div class="card-body postback">
                                @if( $post->img != null)
                                    @foreach($post->img as $img)
                                        <a href="{{url($img)}}" target="_blank">
                                            <img alt="" class="thumb" src="{{url(substr_replace($img ,'s', -4).substr_replace($img, '' ,'s', -4))}}" title="[Click] открыть по центру, [Ctrl+Click] в посте">
                                        </a>
                                    @endforeach
                                @endif
                                <span>{!!$post->message!!}</span>
                            </div>
                        </div>
                    @endforeach
            </div>
        </div>

    <hr>
    @endforeach
    @else
       <div class="alert alert-primary" role="alert">
            Пока что здесь нет тредов.
       </div>
    @endif

@endsection
