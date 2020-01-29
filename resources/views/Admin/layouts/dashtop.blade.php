<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="">
    <title>{{ config('app.name', 'Dashio') }} dashboard</title>

    <!-- Favicons -->
    <link href="{{url('img/favicon.png')}}" rel="icon">
    <link href="{{url('img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('css/backgrounds.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <!--external css-->
    <link href="{{url('css/font-awesome.css')}}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/zabuto_calendar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{url('css/jquery.gritter.css')}}" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet">
    <script src="{{ asset('js/Chart.js') }}"></script>

    <!-- =======================================================
      Template Name: Dashio
      Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
      Author: TemplateMag.com
      License: https://templatemag.com/license/
    ======================================================= -->
</head>


<body class="oppostback">
<section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
        <div class="sidebar-toggle-box">
            <div class="" data-placement="right" data-original-title="Toggle Navigation"><img src="{{url('img/logo1.png')}}" alt="" class="logo"></div>
        </div>
        <!--logo start-->
        <a href="{{route('admin_dashboard')}}" class="logo"><b>{{ config('app.name', 'DASH') }}</b></a>
        <!--logo end-->
        <div class="nav notify-row" id="top_menu">
            <!--  notification start -->
            <ul class="nav top-menu">
                @widget('NewMessages')
                @widget('NewReports')
            </ul>

        </div>
        <div class="top-menu">
            <ul class="nav pull-right top-menu">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Войти') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle logout" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if(ACL::check())
                                <a class="dropdown-item" href="{{route('admin_dashboard')}}">
                                    {{ __('Панель управления') }}
                                </a> <br>
                            @endif
                            <a class="dropdown-item" href="{{route('settings')}}">
                                {{ __('Настройки') }}
                            </a> <br>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Выйти') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    @if(ACL::isAdmin() || ACL::isGlobal_mod())
    <aside>
        <div id="sidebar" class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">
                <li class="mt">
                    <a class="" href="{{route('admin_dashboard')}}">
                        <i class=""></i>
                        <span>Дашборд</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class=""></i>
                        <span>Управление досками</span>
                    </a>
                    <ul class="sub">
                        <li><a href="general.html">Создать доску</a></li>
                        <li><a href="buttons.html">Список досок</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class=""></i>
                        <span>Управление юзерами</span>
                    </a>
                    <ul class="sub">
                        <li><a href="grids.html">Список пользователей</a></li>
                        <li><a href="{{route('admin_reports')}}">Репорты</a></li>
                        <li><a href="calendar.html">Баны</a></li>
                        <li><a href="gallery.html">Премодерация</a></li>
                        <li><a href="todo_list.html">Список модераторов</a></li>
                    </ul>
                </li>
                @endif
                @if(ACL::isAdmin())
                <li class="mt">
                    <a class="" href="{{route('admin_globalset')}}">
                        <i class=""></i>
                        <span>Настройки борды</span>
                    </a>
                </li>
                @endif
                <li class="mt">
                    <a class="" href="{{route('welcome')}}">
                        <i class=""></i>
                        <span>Выход</span>
                    </a>
                </li>
            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>

    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
       MAIN CONTENT
       *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            @yield('content')
        </section>
    </section>
</section>
<script src="{{ asset('js/jquery.min.js') }}"></script>

<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script class="include" type="text/javascript" src="{{ asset('js/jquery.dcjqaccordion.2.7.js') }}"></script>
<script src="{{ asset('js/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('js/jquery.nicescroll.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.sparkline.js') }}"></script>
<!--common script for all pages-->
<script src="{{ asset('js/common-scripts.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.gritter.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/gritter-conf.js') }}"></script>
<!--script for this page-->
<script src="{{ asset('js/sparkline-chart.js') }}"></script>
<script src="{{ asset('js/zabuto_calendar.js') }}"></script>

{{--<script type="text/javascript">--}}
{{--    $(document).ready(function() {--}}
{{--        var unique_id = $.gritter.add({--}}
{{--            // (string | mandatory) the heading of the notification--}}
{{--            title: 'Welcome to Dashio!',--}}
{{--            // (string | mandatory) the text inside the notification--}}
{{--            text: 'Hover me to enable the Close Button. You can hide the left sidebar clicking on the button next to the logo.',--}}
{{--            // (string | optional) the image to display on the left--}}
{{--            image: 'img/ui-sam.jpg',--}}
{{--            // (bool | optional) if you want it to fade out on its own or just sit there--}}
{{--            sticky: false,--}}
{{--            // (int | optional) the time you want it to be alive for before fading out--}}
{{--            time: 8000,--}}
{{--            // (string | optional) the class name you want to apply to that specific message--}}
{{--            class_name: 'my-sticky-class'--}}
{{--        });--}}

{{--        return false;--}}
{{--    });--}}
{{--</script>--}}
<script type="application/javascript">
    $(document).ready(function() {
        $("#date-popover").popover({
            html: true,
            trigger: "manual"
        });
        $("#date-popover").hide();
        $("#date-popover").click(function(e) {
            $(this).hide();
        });

        $("#my-calendar").zabuto_calendar({
            action: function() {
                return myDateFunction(this.id, false);
            },
            action_nav: function() {
                return myNavFunction(this.id);
            },
            ajax: {
                url: "show_data.php?action=1",
                modal: true
            },
            legend: [{
                type: "text",
                label: "Special event",
                badge: "00"
            },
                {
                    type: "block",
                    label: "Regular event",
                }
            ]
        });
    });

    function myNavFunction(id) {
        $("#date-popover").hide();
        var nav = $("#" + id).data("navigation");
        var to = $("#" + id).data("to");
        console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }
</script>
{{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
</body>
</html>
