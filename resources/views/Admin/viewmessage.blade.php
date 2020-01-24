@extends('Admin.layouts.dashtop')

@section('content')
    <section class="wrapper">
        <section class="panel">
            <header class="panel-heading wht-bg">
                <h4>Сообщение от {{$message->from}}</h4>
                <h5 class="gen-case">
                    Тема: {{$message->title}}
                </h5>
            </header>
            <div class="panel-body ">
            <div class="view-mail">
            {!! $message->text !!}
            </div>
            </div>
        </section>
    </section>
@endsection
