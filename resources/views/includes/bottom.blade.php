<style>
    :root {
        --beloved-primary: #eb8abc;
        --beloved-secondary: #fafafa;
        --beloved-accent: #fce9c2;
        --beloved-dark: #d67aa8;
    }

    /* Add padding to body to prevent content from being hidden behind the fixed navbar */
    body {
        padding-bottom: 80px;
    }

    .bottom-navbar {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        z-index: 1030; /* Higher than Bootstrap's default z-index */
        padding: 8px 0 12px 0;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
    }

    .bottom-nav-container {
        display: flex;
        justify-content: space-around;
        align-items: center;
        max-width: 100%;
        margin: 0 auto;
        padding: 0 15px;
    }

    .bottom-nav-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none;
        color: black !important;
        font-size: 0.75rem;
        font-weight: 500;
        padding: 8px 12px;
        border-radius: 12px;
        transition: all 0.3s ease;
        min-width: 60px;
        text-align: center;
        flex: 1;
        max-width: 80px;
    }

    .bottom-nav-item:hover,
    .bottom-nav-item.active {
        color: #000000 !important;
        background-color: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
        text-decoration: none;
    }

    .bottom-nav-icon {
        font-size: 1.4rem;
        margin-bottom: 2px;
        display: block;
    }

    .bottom-nav-text {
        font-size: 0.7rem;
        line-height: 1;
        margin-top: 2px;
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .bottom-nav-text {
            font-size: 0.65rem;
        }

        .bottom-nav-icon {
            font-size: 1.2rem;
        }

        .bottom-nav-item {
            padding: 6px 8px;
            min-width: 50px;
        }
    }

    @media (max-width: 320px) {
        .bottom-nav-container {
            padding: 0 8px;
        }

        .bottom-nav-text {
            font-size: 0.6rem;
        }
    }

    .bottom-nav-item.active .bottom-nav-icon {
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
    }
</style>

<!-- Bottom Navigation Bar -->
<nav class="bottom-navbar">
    <div class="bottom-nav-container">
        <a href="{{route('home')}}" class="bottom-nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
            <span class="bottom-nav-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                    <polyline points="9,22 9,12 15,12 15,22"/>
                    <circle cx="12" cy="16" r="1" fill="currentColor"/>
                </svg>
            </span>
            <span class="bottom-nav-text">Home</span>
        </a>

        <a href="{{route('cart.show')}}" class="bottom-nav-item {{ request()->routeIs('cart.*') ? 'active' : '' }}">
            <span class="bottom-nav-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 7h16l-1 10H5L4 7z"/>
                    <path d="M4 7L2 3H1"/>
                    <circle cx="9" cy="20" r="1" fill="currentColor"/>
                    <circle cx="20" cy="20" r="1" fill="currentColor"/>
                </svg>
            </span>
            <span class="bottom-nav-text">Cart</span>
        </a>

        @auth
            <a href="{{route('orders.index')}}" class="bottom-nav-item {{ request()->routeIs('orders.*') ? 'active' : '' }}">
                <span class="bottom-nav-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                        <path d="M9 9h6v6H9z"/>
                        <path d="M21 9H3"/>
                        <path d="M9 21V3"/>
                    </svg>
                </span>
                <span class="bottom-nav-text">Orders</span>
            </a>

            <a href="{{route('profile.show')}}" class="bottom-nav-item {{ request()->routeIs('profile.show') ? 'active' : '' }}">
                <span class="bottom-nav-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="5"/>
                        <path d="M3 21v-2a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4v2"/>
                    </svg>
                </span>
                <span class="bottom-nav-text">Profile</span>
            </a>
        @else
            <a href="{{route('login')}}" class="bottom-nav-item">
                <span class="bottom-nav-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                        <polyline points="10,17 15,12 10,7"/>
                        <line x1="15" y1="12" x2="3" y2="12"/>
                    </svg>
                </span>
                <span class="bottom-nav-text">Login</span>
            </a>
        @endauth
    </div>
</nav>
