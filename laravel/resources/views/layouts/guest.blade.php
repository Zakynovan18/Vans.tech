<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Vanstech</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
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
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Vanstech</h1>
                <p class="lead fw-normal text-white-50 mb-0"> Power Up Your Gaming Experience!</p>
            </div>
        </div>
    </header>
    <!-- Section-->
    @yield('isi')

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
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>

</body>

</html>
