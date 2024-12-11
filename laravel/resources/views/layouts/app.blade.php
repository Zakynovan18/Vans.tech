{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vanss.tech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
    
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container px-4 px-lg-5">
            <!-- Logo atau Nama Brand -->
            <a class="navbar-brand" href="#">Vanstech</a>
            
            <!-- Tombol untuk mobile menu -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#!">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#!">About</a>
                    </li>
                </ul>
                
                <!-- Cart -->
                <form class="d-flex">
                    <a class="btn btn-outline-light" href="{{ route('cart.index') }}">
                        <i class="bi bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-light text-dark ms-1 rounded-pill">{{ $cartCount ?? 0 }}</span>
                    </a>
                </form>
                
                <!-- Authentication Links -->
                <div class="d-flex ms-3">
                    @if (Auth::check())
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-outline-light">Logout</button>
                        </form>
                    @else
                        <a class="btn btn-outline-light" href="{{ route('login') }}">Login</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="content container my-4">
        @yield('content')
    </div>

    <footer class="py-5 bg-dark text-white">
        <div class="container">
            <div class="row">
                <!-- Deskripsi Singkat -->
                <div class="col-md-4">
                    <h5>Tentang Vanstech</h5>
                    <p>
                        Vanstech adalah platform e-commerce terpercaya yang menyediakan peripheral gaming berkualitas tinggi untuk meningkatkan pengalaman gaming Anda.
                    </p>
                </div>
                <!-- Media Sosial -->
                <div class="col-md-4">
                    <h5>Ikuti Kami</h5>
                    <ul class="list-unstyled">
                        <li><a href="https://facebook.com" class="text-white text-decoration-none"><i class="bi bi-facebook"></i> Facebook</a></li>
                        <li><a href="https://twitter.com" class="text-white text-decoration-none"><i class="bi bi-twitter"></i> Twitter</a></li>
                        <li><a href="https://instagram.com" class="text-white text-decoration-none"><i class="bi bi-instagram"></i> Instagram</a></li>
                        <li><a href="https://linkedin.com" class="text-white text-decoration-none"><i class="bi bi-linkedin"></i> LinkedIn</a></li>
                    </ul>
                </div>
                <!-- Alamat -->
                <div class="col-md-4">
                    <h5>Alamat Kami</h5>
                    <p>
                        Jl. Semarang No.05 Lowokwaru, Kota Malang, Indonesia <br />
                        Email: support@vanstech.com <br />
                        Telp: +62-812-3456-7890
                    </p>
                </div>
            </div>
            <hr class="bg-white" />
            <p class="m-0 text-center">Copyright &copy; Vanstech 2024</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
