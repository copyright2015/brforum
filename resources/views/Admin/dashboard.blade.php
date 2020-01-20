@extends('Admin.layouts.dashtop')

@section('content')
    <div class="col-lg-9 main-chart">
        <!--CUSTOM CHART START -->
        <div class="border-head">
            <h3>Постов на досках</h3>
        </div>
        <div class="custom-bar-chart">
            <ul class="y-axis">
                <li><span>10.000</span></li>
                <li><span>8.000</span></li>
                <li><span>6.000</span></li>
                <li><span>4.000</span></li>
                <li><span>2.000</span></li>
                <li><span>0</span></li>
            </ul>
            @foreach($stat as $board)
            <div class="bar">
                <div class="title">/{{$board->board_prefix}}/</div>
                <div class="value tooltips" data-original-title="{{$board->total_posts}}" data-toggle="tooltip" data-placement="top">{{$board->total_posts / 10000 * 100}}</div>
            </div>
            @endforeach
        </div>
        <!--custom chart end-->

@endsection
