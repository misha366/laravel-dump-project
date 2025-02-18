<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts Site</title>
    @vite(['resources/css/mainpage.css'])
</head>
<body>

    <div class="mainpage">
        <h1 class="mainpage__title">Laravel Dump Project</h1>
        <div class="mainpage__description">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sequi, commodi!</div>
        <a href="{{ route("posts.index") }}" class="btn btn-primary">Explore <i class="bi bi-rocket-takeoff"></i></a>
    </div>

    <div id="tsparticles"></div>

    @vite(['resources/js/homepage-particles.js'])
</body>
</html>
