<li id="header_inbox_bar" class="dropdown">
    <a data-toggle="dropdown" class="dropdown-toggle" href="{{route('admin_dashboard')}}#">
        <i class=""><img src="{{url('img/report.png')}}" alt=""></i>
        @if(count($reports)>0)
        <span class="badge bg-theme">{{count($reports)}}</span>
        @endif
    </a>
    <ul class="dropdown-menu extended inbox">
        <div class="notify-arrow notify-arrow-green"></div>
        <li>
            <p class="green">Новые репорты ({{count($reports)}})</p>
        </li>
        @foreach($reports as $report)
        <li>
            <a href="{{route('admin_view_report', ['report_id' => $report->id])}}">
                                <span class="subject">
                  <span class="from"> >>{{$report->post->id}}</span>
                  <span class="time">{{$report->created_at}}</span>
                  </span>
                <span class="message">
                  {{$report->case}}
                  </span>
            </a>
        </li>

        @endforeach
        <li>
            <a href="{{route('admin_reports')}}">Посмотреть все</a>
        </li>
    </ul>
</li>
<!-- inbox dropdown end -->
