@extends('Admin.layouts.dashtop')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/to-do.css') }}">
    <!-- COMPLEX TO DO LIST -->
    <div class="row mt">
        <div class="col-md-12">
            <section class="task-panel tasks-widget">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h5>Репорты(жалобы)</h5>
                    </div>
                    <br>
                </div>
                <div class="panel-body">
                    <div class="task-content">
                        <ul class="task-list">
                            @foreach($reports as $report)
                                <li>
                                    <div class="task-title">
                                        <span class="task-title-sp"><a href="{{route('admin_view_report', ['report_id' => $report->id])}}">{{$report->case}}</a></span>
                                        @if($report->is_readed == false)<span class="badge bg-important">Новое</span>@endif
                                        <form method="post" class="pull-right">
                                            @csrf
                                            <input type="hidden" name="message_id" value="{{$report->id}}">
                                            <input type="hidden" name="action" value="delete">
                                            <button class="btn btn-danger btn-xs">Удалить</button>
                                        </form>
                                        <form method="post" class="pull-right">
                                            @csrf
                                            <input type="hidden" name="message_id" value="{{$report->id}}">
                                            <input type="hidden" name="action" value="delete">
                                            <button class="btn btn-success btn-xs">Забанить</button>
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

    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="{{ asset('js/tasks.js') }}" type="text/javascript"></script>
@endsection
