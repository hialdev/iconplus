<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IconPlus PLN - Meeting Room Management</title>

    <!-- Include Bootstrap CSS from CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Include Poppins font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Your other stylesheets and scripts go here -->
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light m-2 mx-3 bg-light p-2 px-3 rounded-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="/"><img src="/src/images/logo.png" alt="Logo Icon Plus" style="height: 3em;object-fit:cover"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ms-auto" id="navbarText">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex gap-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'text-dark' : '' }}" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('order*') ? 'text-dark' : '' }}" href="/order">Pesan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('cek-ketersediaan*') ? 'text-dark' : '' }}" href="/cek-ketersediaan">Cek Ketersediaan</a>
                    </li>
                    @if (Auth::check())
                        <li class="nav-item"><a href="#" class="nav-link">|</a></li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('dashboard') ? 'text-dark' : '' }}" href="{{route('dashboard.index')}}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('dashboard/setting-admin*') ? ' text-dark' : '' }}" href="{{route('dashboard.setting-admin')}}">Set Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('dashboard/room*') ? ' text-dark' : '' }}" href="{{route('rooms.index')}}">Manage Room</a>
                        </li>
                        <li class="nav-item ms-auto flex-fill align-self-end">
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-{{ Auth::check() ? 'outline-danger' : 'primary' }}">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item ms-auto flex-fill align-self-end">
                            <a href="/login" class="btn btn-{{ Auth::check() ? 'light' : 'primary' }}">Login</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="py-5">
        @yield('content')
    </div>

    <footer>
        <div class="text-center fs-6 text-secondary">
            <h6>This Build by <span class="text-primary">Devtektif</span> - <span class="text-primary">@hialdev @hiamalif</span></h6>
        </div>
    </footer>

    <!-- Include Bootstrap JS and jQuery from CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @yield('script')


</body>
</html>