<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ url('assets/main.css') }}">
</head>
<body>
<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex ">
        {{ env('APP_NAME') }}
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item">
            <a class="nav-link" href="charts.html">
                Class
            </a>
        </li>
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
<div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <header class="header header-sticky mb-4">
        <div class="container-fluid">
            <button class="header-toggler px-md-0 me-md-3" type="button"
                    onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </button>

            <ul class="header-nav d-none d-md-flex">
                <li class="nav-item"><a class="nav-link" href="#">Dashboard</a></li>
            </ul>
            <ul class="header-nav d-none d-md-flex ms-auto">
                <li class="nav-item"><a class="nav-link" href="#">Logout</a></li>
            </ul>
        </div>
    </header>
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <!-- /.row-->
        </div>
    </div>
    <footer class="footer">
      <div>© 2023
          <a href="//dimanda.my.id">telo</a>
      </div>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.2.0/dist/js/coreui.bundle.min.js"
        integrity="sha384-n0qOYeB4ohUPebL1M9qb/hfYkTp4lvnZM6U6phkRofqsMzK29IdkBJPegsyfj/r4"
        crossorigin="anonymous"></script>
</body>
</html>
