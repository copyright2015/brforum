@extends('layouts.app')

@section('content')
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
    <div class="card mb-4">
        <div class="card-header banana">
            <h6 class="my-0 font-weight-normal">{{$thread->theme}} | {{$thread->created_at}} | <a href="#" name="">{{$thread->id}}</a> </h6>
        </div>
        <div class="card-body oppostback">
            <span>{!! $thread->message !!}</span>
            @if( $thread->img != null)
                @foreach($thread->img as $img)
                    <a href="{{url($img)}}" target="_blank">
                        <img alt="" class="thumb" src="{{url(substr_replace($img ,'s', -4).substr_replace($img, '' ,'s', -4))}}" title="[Click] открыть по центру, [Ctrl+Click] в посте">
                    </a>
                @endforeach
            @endif
            @if(count($posts) > 0)
                @foreach($posts as $post)
                    <div class="card mb-4">
                        <div class="card-header banana">
                            <h6 class="my-0 font-weight-normal">{{$post->theme}} | {{$post->created_at}} | <a href="#{{$post->id}}" name="{{$post->id}}">{{$post->id}}</a></h6>
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
                            <br>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-primary" role="alert">
                    Пока что здесь нет постов.
                </div>
            @endif
        </div>
    </div>

@endsection
