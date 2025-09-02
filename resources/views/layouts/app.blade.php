<?php 
    $userName = auth()->user()['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Aplikasi Rumah Sakit</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-primary mb-5" data-bs-theme="dark">
        <div class="container-fluid">
        <a class="navbar-brand">Hospitals</a>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link {{ request()->routeIs('hospitals.*') ? 'active' : '' }}" href="{{ route('hospitals.index') }}" aria-current="page" href="#">Daftar Rumah Sakit</a>
                    <a class="nav-link {{ request()->routeIs('patients.*') ? 'active' : '' }}" href="{{ route('patients.index') }}">Pasien</a>
                </div>
            </div>

           <div class="d-flex">
                 <span class="navbar-text me-2">
                    {{$userName}}
                </span>

                <form class="d-flex" action="{{ route('logout') }}">
                                <button class="btn btn-primary" type="submit">Logout</button>
                </form>
          
           </div>
               
           
        </div>
    </nav>

     @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    @yield('scripts')
</body>
</html>