@extends('Admin.layouts.dashtop')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-fileupload.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datepicker.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/daterangepicker.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/timepicker.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datertimepicker.css') }}" />

    <section class="wrapper">
        <section class="panel">
            <header class="panel-heading wht-bg">
                <h4>Репорт на пост >>{{$report->post->id}}</h4>
                <h5 class="gen-case">
                    Причина: {{$report->case}}
                    <br>
                    Ip: {{ACL::isAdmin() ? $report->post->Ip_hash : md5($report->post->Ip_hash)}}
                </h5>
            </header>
            <div class="panel-body ">
                <div class="view-mail">
                 {!! $report->post->message !!}
                </div>
            </div>
        </section>
        <div class="row mt">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <h4 class="title">Забанить?</h4>
                <div id="message"></div>
                <form class="contact-form php-mail-form" role="form" method="POST">
                    @csrf
                    @if(!Session::has('success'))
                    <div class="form-group">
                        <input type="text" name="case" class="form-control" placeholder="Причина бана">
                        <div class="validate"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="sign" class="form-control" placeholder="Подпись под постом" value="Автор поста забанен">
                        <div class="validate"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="period" class="form-control" placeholder="Напишите время бана">
                        <div class="validate"></div>
                        <span>Время пишется по типу 1 day или 3 hours</span>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name ="ban404" value="true">
                            Бан 404?
                        </label>
                    </div>



                    <input type="hidden" name ="post_id" value="{{$report->post->id}}">
                    <div class="loading"></div>
                    <div class="error-message"></div>

                    <div class="form-send">
                        <button type="submit" class="btn btn-large btn-primary">Отправить</button>
                    </div>
                    @else    <span>{!!Session::get('success') !!}</span>
                    @endif

                </form>
            </div>
        </div>
    </section>

    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="{{ asset('js/tasks.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery-ui-1.9.2.custom.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/bootstrap-fileupload.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/date.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/daterangepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-timepicker.js') }}"></script>
    <script src="{{ asset('js/advanced-form-components.js') }}"></script>
@endsection
