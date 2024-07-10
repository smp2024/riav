<!DOCTYPE html>
<!--html-->
    <html lang="es">
        <!--head-->
            <head>

                <!--metas-->
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <meta name="routeName" content="{{ Route::currentRouteName() }}">

                <!--icon-->
                    <link rel="icon" type="image/png" href="{{ url('multimedia'.$company[0]->file_path.'/'.$company[0]->file) }}" />

                <!--title-->
                    <title>{{ config('app.name') }} @yield('title')</title>

                <!--CSS-->
                    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
                    <link rel="stylesheet" href="{{ url('/fontawesome/css/all.css') }}">
                    <link rel="stylesheet" href="{{ url('/css/admin.css?v='.time()) }}">

            </head>
        <!--body-->
            <body>
                <!--Body content-->
                    <div class="wrapper">

                        <!--Sidebar menu-->
                            <div id="Admin-sidebar" class="col1">
                                @include('admin.sidebar')
                            </div>

                        <!--Content Page-->
                            <div id="Admin-content" class="col2">

                                <!--Navbar-->
                                    @include('admin.navbar')

                                <!--Alert errors-->
                                    @if (Session::has('message'))
                                        <div class="container">
                                            <div class="alert alert-{{ Session::get('typealert') }}" style="display: none;">
                                                {{ Session::get('message') }}
                                                @if ($errors->any())
                                                <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                <!--Content Page-->
                                    @section('content')
                                        hola mundo
                                    @show

                            </div>

                    </div>

                <!--Script-->
                    <script src="{{ asset('js/jquery.js') }}"></script>
                    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
                    <script src="{{ asset('js/utils.js') }}"></script>
                    <script src="{{ asset('js/contador.js?v='.time()) }}"></script>
                    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
                    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
                    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

                    <script src="{{ asset('js/admin.js') }}"></script>

                    @yield('scripts')



            </body>
    </html>
