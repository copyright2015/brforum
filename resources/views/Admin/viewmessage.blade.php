@extends('Admin.layouts.dashtop')

@section('content')
    <section class="wrapper">
        <section class="panel">
            <header class="panel-heading wht-bg">
                <h4 class="gen-case">
                    {{$message->title}}
                </h4>
            </header>
            <div class="panel-body ">
            <div class="view-mail">
            {!! $message->text !!}
            </div>
            </div>
        </section>
    </section>
@endsection
