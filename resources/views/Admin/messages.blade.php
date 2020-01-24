@extends('Admin.layouts.dashtop')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/to-do.css') }}">
    <!-- COMPLEX TO DO LIST -->
    <div class="row mt">
        <div class="col-md-12">
            <section class="task-panel tasks-widget">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h5>Сообщения</h5>
                    </div>
                    <br>
                </div>
                <div class="panel-body">
                    <div class="task-content">
                        <ul class="task-list">
                            @foreach($messages as $message)
                            <li>
                                <div class="task-title">
                                    <span class="task-title-sp"><a href="{{route('admin_view_message', ['message_id' => $message->id])}}">{{$message->title}}, от {{$message->from}}</a></span>
                                    @if($message->is_readed == false)<span class="badge bg-important">Новое</span>@endif
                                        <form method="post" class="pull-right">
                                            @csrf
                                            <input type="hidden" name="message_id" value="{{$message->id}}">
                                            <input type="hidden" name="action" value="delete">
                                            <button class="btn btn-danger btn-xs">Удалить</button>
                                        </form>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </section>
        </div>
        <!-- /col-md-12-->
        <section class="wrapper">
        <div class="row mt">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <h4 class="title">Написать сообщение</h4>
                <div id="message"></div>
                <form class="contact-form php-mail-form" role="form" method="POST">
                    @csrf
                    <div class="form-group">
                        <select class="form-control" name="user_id">
                            @foreach($admins as $admin)
                            <option value="{{$admin->id}}">{{$admin->name}}</option>
                            @endforeach
                        </select>
                        <div class="validate"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="title" class="form-control" id="contact-email" placeholder="Тема">
                        <div class="validate"></div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="text" id="contact-message" placeholder="Your Message" rows="5"></textarea>
                        <div class="validate"></div>
                    </div>

                    <div class="loading"></div>
                    <div class="error-message"></div>

                    <input type="hidden" name="action" value="send">
                    <input type="hidden" name="from" value="{{Auth::user()->name}}">
                    <div class="form-send">
                        <button type="submit" class="btn btn-large btn-primary">Отправить</button>
                    </div>

                </form>
            </div>
        </div>
        </section>

    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="{{ asset('js/tasks.js') }}" type="text/javascript"></script>
@endsection
