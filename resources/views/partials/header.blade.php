<nav class="navbar navbar-expand-lg bg-info navbar-dark ">
    <!-- Container wrapper -->
    <div class="container-fluid">

        <!-- Navbar brand -->
        <a class="navbar-brand" href="{{route('index')}}">
            <small>Gerenciador de Depósito <i class="fa-solid fa-warehouse"></i></small>
        </a>

        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

{{--                <!-- Link -->--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="#">Link</a>--}}
{{--                </li>--}}

                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        Produtos
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="{{route('index')}}">Produtos</a>
                        </li>
{{--                        <li>--}}
{{--                            <hr class="dropdown-divider" />--}}
{{--                        </li>--}}
                        <li>
                            <a class="dropdown-item" href="{{route('inativos')}}">Produtos inativos</a>
                        </li>
{{--                        <li>--}}
{{--                            <a class="dropdown-item" href="#">Something else here</a>--}}
{{--                        </li>--}}
                    </ul>
                </li>

            </ul>

        </div>
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->