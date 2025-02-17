<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css'])
</head>
<body class="pb-3">

<div style="display: none" class="container page">
    <x-common.topmenu></x-common.topmenu>
    <x-common.authoffcanvas></x-common.authoffcanvas>
    @yield('content')
    <x-common.addpostbutton></x-common.addpostbutton>
</div>

<x-common.preloader></x-common.preloader>

@vite(['resources/js/app.js'])
</body>
</html>