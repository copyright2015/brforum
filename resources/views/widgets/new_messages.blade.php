<!-- inbox dropdown start-->
<li id="header_inbox_bar" class="dropdown">
    <a data-toggle="dropdown" class="dropdown-toggle" href="{{route('admin_dashboard')}}#">
        <i class=""><img src="{{url('img/mail.png')}}" alt=""></i>
        @if(count($messages)>0)
        <span class="badge bg-theme">{{count($messages)}}</span>
        @endif
    </a>
    <ul class="dropdown-menu extended inbox">
        <div class="notify-arrow notify-arrow-green"></div>
        <li>
            <p class="green">Новые собщения ({{count($messages)}})</p>
        </li>
        @foreach($messages as $message)
        <li>
            <a href="{{route('admin_view_message', ['message_id' => $message->id])}}#">
                                <span class="subject">
                  <span class="from">{{$message->from}}</span>
                  <span class="time">{{$message->created_at}}</span>
                  </span>
                <span class="message">
                  {{$message->title}}
                  </span>
            </a>
        </li>
        @endforeach
        <li>
            <a href="{{route('admin_inbox')}}#">Посмотреть все</a>
        </li>
    </ul>
</li>
<!-- inbox dropdown end -->
