<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('panel.site_title') }}</title>
    <link href="{{asset('css/all/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/all/coreui.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/all/font-awesome.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/all/all.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/all/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>--}}
    <link href="{{asset('css/all/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/all/bootstrap-datetimepicker.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/all/dropzone.min.css')}}" rel="stylesheet"/>

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet"/>
    @yield('styles')
</head>

<body class="header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden login-page">
<div class="app flex-row align-items-center">
    <div class="container">
        @yield("content")
    </div>
</div>
@yield('scripts')
</body>

</html>
