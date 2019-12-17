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
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(count($threads) > 0)
                        @foreach($threads as $thread)
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header banana">
                                    <h4 class="my-0 font-weight-normal">{{$thread->theme}}</h4>
                                </div>
                                <div class="card-body oppostback">
                                    <span>{{$thread->message}}</span>
                                    @if( $thread->img != null)
                                        @foreach($thread->img as $img)
                                            <a href="{{url($img)}}" target="_blank">
                                                <img alt="" class="thumb" src="{{url(substr_replace($img ,'s', -4).substr_replace($img, '' ,'s', -4))}}" title="[Click] открыть по центру, [Ctrl+Click] в посте">
                                            </a>
                                        @endforeach
                                    @endif
                                    <br>
                                   <span> <a href="{{route('thread',['board_prefix'=>$board->prefix,'thread_id'=>$thread->id])}}">Ответить</a></span>
                                    @foreach($thread->posts as $post)
                                        <div class="card mb-4 shadow-sm">
                                            <div class="card-header banana">
                                                <h4 class="my-0 font-weight-normal">{{$post->theme}}</h4>
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
                                    <hr>
                                @endforeach
                        @else
                                <div class="alert alert-primary" role="alert">
                                    Пока что здесь нет тредов.
                                </div>
                        @endif
                    </div>
@endsection
