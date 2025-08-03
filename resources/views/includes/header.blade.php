<style>
    :root {
        --beloved-primary: #eb8abc;
        --beloved-secondary: #fafafa;
        --beloved-accent: #fce9c2;
        --beloved-dark: #d67aa8;
    }

    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1030;
        background-color: white;
        box-shadow: 0 2px 15px rgba(235, 138, 188, 0.3);
        padding: 1rem 0;
    }

    /* Add padding to body to prevent content from hiding behind fixed navbar */
    body {
        padding-top: 80px; /* Adjust this value based on your navbar height */
    }

    .navbar-brand {
        color: #000000 !important;
        font-weight: bold;
        font-size: 1.5rem;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
    }

    .navbar-nav .nav-link {
        color: black !important;
        font-weight: 500;
        margin: 0 0.5rem;
        padding: 0.5rem 1rem !important;
        border-radius: 25px;
        transition: all 0.3s ease;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
        background-color: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }

    @media (max-width: 991px) {
        .navbar-collapse {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 1rem;
            margin-top: 1rem;
        }
    }
</style>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('home')}}">✨ Beloved</a>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

            @auth

                <li class="nav-item">
                    <a class="nav-link" href="{{route('logout')}}">🚪 Logout</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}">🔐 Login</a>
                </li>
            @endauth
        </ul>

    </div>
</nav>
