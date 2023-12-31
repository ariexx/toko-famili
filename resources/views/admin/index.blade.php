<!DOCTYPE html>
<html lang="en">

<head>
{{--    @include('partials.head')--}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{asset('assets/img/icons/icon-48x48.png')}}" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>{{config('app.name')}} - {{ $subTitle }}</title>

    <link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
@include('sweetalert::alert')
<div class="wrapper">
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="{{(auth()->user()->isUser() ? route('user.dashboard') : route('admin.dashboard'))}}">
                <span class="align-middle">{{config('app.name')}}</span>
            </a>
            @include('partials.sidebar')
        </div>
    </nav>

    <div class="main">
        @include('partials.navbar')
        <main class="content">
            <div class="container-fluid p-0">
                @yield('content')
            </div>
        </main>

        {{-- implement footer --}}
        @include('partials.footer')
    </div>
</div>

<script src="{{asset('assets/js/app.js')}}"></script>
@stack('admin-dashboard-js')
</body>
</html>
