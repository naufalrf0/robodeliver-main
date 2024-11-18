<header class="header black_nav clearfix element_to_stick">
    <div class="container">
        <div id="logo">
            <a href="{{ route('home') }}">
                <img id="logoDefault" src="{{ asset('assets/img/logo-white.png') }}" height="48" alt="Logo Default" class="d-block">
                <img id="logoScrolled" src="{{ asset('assets/img/logo.png') }}" height="48" alt="Logo Scrolled" class="d-none">
            </a>
        </div>
        
        <div class="layer"></div><!-- Opacity Mask Menu Mobile -->

        <ul id="top_menu" class="drop_user">
            @auth
                <li>
                    <div class="dropdown user clearfix">
                        <a href="#" data-bs-toggle="dropdown">
                            <figure>
                                <img src="{{ Auth::user()->avatar ?? asset('assets/img/user_avatar.png') }}" alt="User Avatar" width="30" height="30">
                            </figure>
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-content">
                                <ul>
                                    <li><a href="#"><i class="icon_wallet"></i> Saldo: Rp{{ number_format(Auth::user()->wallet_balance, 0, ',', '.') }}</a></li>
                                    <li><a href="{{ route('dashboard') }}"><i class="icon_cog"></i> Dashboard</a></li>
                                    <li><a href="#0"><i class="icon_document"></i> Bookings</a></li>
                                    <li><a href="#0"><i class="icon_heart"></i> Wish List</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}" 
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="icon_key"></i> Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
            @else
                <li>
                    <a href="{{ route('login') }}" id="sign-in" class="btn_1 gradient small">Masuk/Daftar</a>
                </li>
            @endauth
        </ul>
        <!-- /top_menu -->

        <a href="#0" class="open_close">
            <i class="icon_menu"></i><span>Menu</span>
        </a>

        <nav class="main-menu">
            <div id="header_menu">
                <a href="#0" class="open_close">
                    <i class="icon_close"></i><span>Menu</span>
                </a>
                <a href="{{ route('home') }}"><img src="{{ asset('assets/img/logo.svg') }}" width="162" height="35" alt="Logo"></a>
            </div>
            <ul>
                @foreach($navigation as $nav)
                    <li class="{{ isset($nav['children']) ? 'submenu' : '' }}">
                        <a href="{{ $nav['route'] !== '#' ? route($nav['route']) : '#' }}" class="show-submenu">
                            {{ $nav['name'] }}
                        </a>
                        @if(isset($nav['children']))
                            <ul>
                                @foreach($nav['children'] as $child)
                                    <li><a href="{{ route($child['route']) }}">{{ $child['name'] }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
</header>
