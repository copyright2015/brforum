@extends('layouts.app')

@section('content')
    <div class="container">
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
                <input type="file" id="img" name="imgs[]" multiple class="form-control @error('img') is-invalid @enderror">
                @error('img')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button type="Ответить" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $board->name }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header">
                                    <h4 class="my-0 font-weight-normal">{{$thread->theme}}</h4>
                                </div>
                                <div class="card-body">
                                    <span>{{$thread->message}}</span>
                                </div>
                            </div>
                            @if(count($posts) > 0)
                                @foreach($posts as $post)
                                    <div class="card mb-4 shadow-sm">
                                        <div class="card-header">
                                            <h4 class="my-0 font-weight-normal">{{$post->theme}}</h4>
                                        </div>
                                        <div class="card-body">
                                            @if( $post->img != null)
                                                @foreach($post->img as $img)
                                                    <a href="{{url($img)}}" target="_blank">
                                                        <img class="thumb" src="{{url(substr_replace($img ,'s', -4).substr_replace($img, '' ,'s', -4))}}" width="200" height="144" title="[Click] открыть по центру, [Ctrl+Click] в посте">
                                                    </a>
                                                @endforeach
                                            @endif
                                            <span>{{$post->message}}</span>
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
            </div>
        </div>
    </div>
@endsection
