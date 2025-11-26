@auth
@php
$user = Auth::user();
$user_role = $user->getRoleNames()[0];
@endphp
@endauth

<style>
    :root {
        --island-bg: rgba(15, 15, 15, 0.85);
        --island-bg-scrolled: rgba(0, 0, 0, 0.95);
        --island-border: 1px solid rgba(255, 255, 255, 0.1);
        --island-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
        --island-radius: 100px;
        --island-accent: #990000;
        --text-main: #ffffff;
        --text-muted: rgba(255, 255, 255, 0.7);
    }

    #header {
        position: fixed;
        top: 30px;
        left: 0;
        right: 0;
        z-index: 1000;
        display: flex;
        justify-content: center;
        pointer-events: none;
        transition: all 0.5s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    .dynamic-island {
        background: var(--island-bg);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: var(--island-border);
        box-shadow: var(--island-shadow);
        border-radius: var(--island-radius);
        padding: 0.7rem 1.2rem;
        width: auto;
        min-width: 600px;
        max-width: 90%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        pointer-events: auto;
        transition: all 0.5s cubic-bezier(0.2, 0.8, 0.2, 1);
        gap: 2rem;
    }

    #header.scrolled {
        top: 15px;
        justify-content: flex-start;
        padding-left: 30px;
    }

    #header.scrolled .dynamic-island {
        background: var(--island-bg-scrolled);
        padding: 0.5rem 1rem;
        min-width: auto;
        gap: 1rem;
        border-radius: 50px;
    }

    .island-logo a {
        display: flex;
        align-items: center;
    }

    .island-logo img {
        height: 35px;
        width: auto;
        transition: height 0.3s ease;
    }

    #header.scrolled .island-logo img {
        height: 28px;
    }

    .island-nav ul {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 25px;
        align-items: center;
    }

    .island-nav a {
        color: var(--text-muted);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        transition: color 0.3s ease;
        white-space: nowrap;
    }

    .island-nav a:hover, .island-nav a.active {
        color: var(--text-main);
    }

    .btn-auth-wrapper {
        display: flex;
        align-items: center;
    }

    .btn-auth {
        background: var(--island-accent);
        color: white;
        padding: 8px 20px;
        border-radius: 30px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        white-space: nowrap;
        border: 1px solid var(--island-accent);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-auth:hover {
        background: transparent;
        color: var(--island-accent);
    }

    .user-pill {
        background: rgba(255,255,255,0.1);
        padding: 6px 16px;
        border-radius: 30px;
        color: white;
        font-size: 0.85rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: background 0.3s;
    }

    .user-pill:hover {
        background: rgba(255,255,255,0.2);
    }

    .auth-dropdown {
        position: absolute;
        top: 120%;
        right: 0;
        background: #1a1a1a;
        border: 1px solid #333;
        border-radius: 15px;
        padding: 10px;
        min-width: 180px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.2s ease;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .btn-auth-wrapper:hover .auth-dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .auth-dropdown a {
        color: #ddd;
        text-decoration: none;
        font-size: 0.85rem;
        padding: 8px 12px;
        border-radius: 8px;
        display: block;
        transition: background 0.2s;
    }

    .auth-dropdown a:hover {
        background: rgba(255,255,255,0.1);
        color: white;
    }

    .mobile-toggle {
        display: none;
        color: white;
        font-size: 1.2rem;
        cursor: pointer;
    }

    @media (max-width: 991px) {
        #header {
            top: 20px;
        }
        
        #header.scrolled {
            justify-content: center;
            padding-left: 0;
        }

        .dynamic-island {
            min-width: auto;
            width: 90%;
            padding: 0.6rem 1.2rem;
        }

        .island-nav {
            display: none;
            position: absolute;
            top: 110%;
            left: 0;
            width: 100%;
            background: #111;
            border: 1px solid #333;
            border-radius: 20px;
            padding: 20px;
            flex-direction: column;
        }

        .island-nav.show {
            display: flex;
        }

        .island-nav ul {
            flex-direction: column;
            gap: 15px;
        }

        .btn-auth-wrapper {
            display: none;
        }

        .mobile-toggle {
            display: block;
        }
    }
</style>

<header id="header">
    <div class="dynamic-island">
        <div class="island-logo">
            <a href="/">
                <img alt="Musma" src="img/logo-musma.png">
            </a>
        </div>

        <div class="island-nav">
            @if($title == 'Rekapitulasi')
                <ul>
                    <li><a href="/" class="active">Home</a></li>
                    <li><a href="#smft" data-hash data-hash-offset="75">SMFT</a></li>
                    <li><a href="#bpmft" data-hash data-hash-offset="75">BPMFT</a></li>
                    
                    @auth
                        <li class="d-lg-none"><a href="#">{{ Auth::user()->nim }}</a></li>
                        @if ($user->hasRole('admin') || $user->hasRole('sekre'))
                            <li class="d-lg-none"><a href="/admin">Admin</a></li>
                        @endif
                        <li class="d-lg-none"><a href="{{ route('logout') }}">Logout</a></li>
                    @endauth
                    @guest
                        <li class="d-lg-none"><a href="@if (Route::has('auth')) {{route('auth')}} @else # @endif">Login</a></li>
                    @endguest
                </ul>
            @else
                <ul>
                    <li><a href="#home" data-hash class="active">Home</a></li>
                    @if (Route::has('rekap'))
                        <li><a href="{{ route('rekap') }}">Rekapitulasi</a></li>
                    @endif
                    <li><a href="#tentang" data-hash data-hash-offset="68">Tentang</a></li>
                    <li><a href="#Polling" data-hash data-hash-offset="68">Polling</a></li>
                    <li><a href="#contact" data-hash data-hash-offset="68">Kontak</a></li>

                    @auth
                        <li class="d-lg-none"><a href="#">{{ Auth::user()->nim }}</a></li>
                        @if ($user->hasRole('admin') || $user->hasRole('sekre'))
                            <li class="d-lg-none"><a href="/admin">Admin</a></li>
                        @endif
                        <li class="d-lg-none"><a href="{{ route('logout') }}">Logout</a></li>
                    @endauth
                    @guest
                        <li class="d-lg-none"><a href="@if (Route::has('auth')) {{route('auth')}} @else # @endif">Login</a></li>
                    @endguest
                </ul>
            @endif
        </div>

        <div class="btn-auth-wrapper position-relative">
            @guest
                <a href="@if (Route::has('auth')) {{route('auth')}} @else # @endif" class="btn-auth">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
            @endguest

            @auth
                <div class="user-pill">
                    <i class="fas fa-user-circle"></i> {{ Auth::user()->nim }}
                </div>
                <div class="auth-dropdown">
                    @if ($user->hasRole('admin') || $user->hasRole('sekre'))
                        <a href="/admin"><i class="fas fa-cog mr-2"></i> Admin Panel</a>
                    @endif
                    @if (Route::has('logout'))
                        <a href="{{ route('logout') }}"><i class="fas fa-power-off mr-2"></i> Logout</a>
                    @endif
                </div>
            @endauth
        </div>

        <div class="mobile-toggle d-lg-none">
            <i class="fas fa-bars"></i>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const header = document.getElementById('header');
        const mobileToggle = document.querySelector('.mobile-toggle');
        const islandNav = document.querySelector('.island-nav');

        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        if(mobileToggle) {
            mobileToggle.addEventListener('click', function() {
                islandNav.classList.toggle('show');
                const icon = this.querySelector('i');
                if(islandNav.classList.contains('show')) {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-times');
                } else {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            });
        }
    });
</script>