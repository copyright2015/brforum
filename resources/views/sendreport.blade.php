@extends('layouts.app')



@section('content')

    @if(!$is_banned)
        <form method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="case">Причина</label>
                <textarea class="form-control @error('case') is-invalid @enderror" id="case" name="case" rows="3"></textarea>
                @error('case')
                <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <span>{!!Session::get('success') !!}</span>


            <button type="submit" class="btn btn-custom ">Отправить</button>
        </form>
    @else
        <div class="alert alert-danger text-center" role="alert">
            Вы забанены и не можете создавать треды.
            @foreach($bans as $ban)
                Причина: {{$ban->case}} Дата истечения: {{$bans->expire_time}} <br>
            @endforeach
        </div>
    @endif

@endsection
