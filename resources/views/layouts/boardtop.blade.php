<div class="container mb-4 justify-content-center text-center">
    <hr>
    <h2>{{$board->name}}</h2>
    <h3>{{$board->description}}</h3>
    <h5>{{$board->slogan}}</h5>
    <a href="{{route('board',['board_prefix'=>'mod'])}}"><img src="{{url('storage/img/ccd7cbf4e061.png')}}" alt=""></a>
    <hr>
</div>
