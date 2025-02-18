<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Dump Project</title>
    @vite(['resources/css/mainpage.css'])
</head>
<body>

    <div style="display: none" class="page">
        <div class="mainpage">
            <h1 class="mainpage__title">Laravel Dump Project</h1>
            <div class="mainpage__description">
            Have you been looking for a project to test libraries, new approaches and ideas?<br>Here's one of them! 👇</div>
            <div class="mainpage__buttons">
                <a href="{{ route("posts.index") }}" class="btn btn-primary mainpage__button-posts">Explore <i class="bi bi-rocket-takeoff"></i></a>
                <a href="
                    https://github.com/misha366/laravel-dump-project
                " class="btn btn-dark mainpage__button-github"><i class="bi bi-github"></i></a>
            </div>
        </div>

        <div id="tsparticles"></div>

    </div>

    <x-common.preloader></x-common.preloader>

    @vite(['resources/js/homepage-particles.js'])
    @vite(['resources/js/app.js'])
</body>
</html>
