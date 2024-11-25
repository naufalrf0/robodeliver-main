@php
    $menus = [
        'admin' => [
            [
                'icon' => 'fa fa-users',
                'text' => 'Akun',
                'route' => route('admin.users'),
            ],
            [
                'icon' => 'fa fa-list',
                'text' => 'Merchant',
                'route' => route('admin.merchants.index'),
            ],
            // [
            //     'icon' => 'fa fa-store',
            //     'text' => 'Manage Merchants',
            //     'route' => route('admin.merchants'),
            // ],
        ],
        // 'merchant' => [
        //     [
        //         'icon' => 'fa fa-box',
        //         'text' => 'Manage Products',
        //         'route' => route('merchant.products'),
        //     ],
        //     [
        //         'icon' => 'fa fa-shopping-cart',
        //         'text' => 'Manage Orders',
        //         'route' => route('merchant.orders'),
        //     ],
        //     [
        //         'icon' => 'fa fa-wallet',
        //         'text' => 'Manage Balance',
        //         'route' => route('merchant.wallet'),
        //     ],
        // ],
        'customer' => [
            [
                'icon' => 'fa fa-money',
                'text' => 'Transaksi',
                'route' => route('home'),
            ],
            [
                'icon' => 'fa fa-list',
                'text' => 'Pesanan Saya',
                'route' => route('home'),
            ],
        ],
    ];

    $role = auth()->user()->getRoleNames()->first(); // Mendapatkan nama role (Spatie)
@endphp

<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
    {{-- Menu Dashboard (Universal untuk semua role) --}}
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
        </a>
    </li>

    {{-- Menu Berdasarkan Role --}}
    @if (isset($menus[$role]))
        @foreach ($menus[$role] as $menu)
            <li class="nav-item">
                <a class="nav-link" href="{{ $menu['route'] }}">
                    <i class="{{ $menu['icon'] }}"></i>
                    <span class="nav-link-text">{{ $menu['text'] }}</span>
                </a>
            </li>
        @endforeach
    @else
        <li class="nav-item">
            <a class="nav-link disabled">
                <i class="fa fa-fw fa-ban"></i>
                <span class="nav-link-text">No menu available</span>
            </a>
        </li>
    @endif
</ul>
<ul class="navbar-nav sidenav-toggler">
    <li class="nav-item">
        <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
        </a>
    </li>
</ul>
