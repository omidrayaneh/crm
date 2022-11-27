<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    {{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
    {{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/bootstrap.rtl.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">
    @yield('js')
    @yield('css')
</head>
<body dir="rtl">
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-navbar shadow-sm">
        <div class="container">
            <a class="navbar-brand text-white" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                {{--                    <ul class="navbar-nav ml-auto">--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a class="nav-link text-white" href="#">sdsds</a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link text-white mr-auto"
                               href="{{ route('login') }}">{{ __('auth.Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link text-white"
                                   href="{{ route('register') }}">{{ __('auth.Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('auth.Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-right">
                           <div class="row">
                               <div class="col-1">
                                   <a href="/home" class="nav-a">{{__('variable.Home')}}</a>
                               </div>

                               <div class="dropdown col-1 " >
                                   <a class="nav-a dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                      aria-expanded="false">
                                       {{__('variable.Info')}}
                                   </a>
                                   <ul class="dropdown-menu  dropdown-menu-right text-right  ">
                                       <li><a class="dropdown-item" href="/customer">{{__('variable.Customer')}}</a></li>
                                       <li><a class="dropdown-item" href="/vendor">{{__('variable.Vendor')}}</a></li>
                                       <li><a class="dropdown-item" href="/product">{{__('variable.Product')}}</a></li>
                                   </ul>
                               </div>
                               <div class="dropdown col-1 " >
                                   <a class="nav-a dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                      aria-expanded="false">
                                       {{__('variable.Support')}}
                                   </a>
                                   <ul class="dropdown-menu  dropdown-menu-right text-right  " >
                                       <li><a class="dropdown-item" href="/supports">{{__('variable.Supports')}}</a></li>
                                       <li><a class="dropdown-item" href="/events">{{__('variable.Events')}}</a></li>
                                       <li><a class="dropdown-item" href="{{route('events.all')}}">{{__('variable.Last_Events')}}</a></li>

                                       <li><a class="dropdown-item" href="/tasks">{{__('variable.Tasks')}}</a></li>
                                   </ul>
                               </div>
                           </div>


                        </div>
                        @yield('content')

                    </div>


                </div>
            </div>
        </div>
    </main>
</div>

<script src="/js/dt.js"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/flasher.min.js')}}"></script>
</body>
</html>
