@php
    $heroData = [
        'title' => 'Pengantaran Makan Berbasis Robot',
        'subtitle' => 'Dengan teknologi pengiriman otomatis',
        'trending' => $categories->pluck('name')->toArray() ?? ['Pizza', 'Ayam Goreng', 'Seafood', 'Kopi'],
        'formAction' => route('merchants.home.index'), 
    ];
@endphp

<x-home-layout :title="'Robodeliver - Pemesanan Makanan Berbasis Robot'" :metaDescription="'Robodeliver adalah solusi pemesanan makanan berbasis robot dengan pengantaran otomatis dan real-time tracking.'" :metaAuthor="'Robodeliver Inc.'">

    <!-- START SLIDER -->
    <div class="hero_single version_2 kenburns_slider" style="background: none;">
        <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
            <div class="container">
                <div class="row justify-content-lg-start justify-content-md-center">
                    <div class="col-xl-7 col-lg-8">
                        <h1>{{ $heroData['title'] }}</h1>
                        <p>{{ $heroData['subtitle'] }}</p>
                        <form method="get" action="{{ $heroData['formAction'] }}">
                            @csrf
                            <div class="row g-0 custom-search-input">
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <input class="form-control no_border_r" type="text" name="query"
                                            placeholder="What are you looking for...">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <button class="btn_1 gradient" type="submit">Search</button>
                                </div>
                            </div>
                            <div class="search_trends">
                                <h5>Trending:</h5>
                                <ul>
                                    @foreach ($heroData['trending'] as $item)
                                        <li><a
                                                href="{{ route('merchants.home.index', ['category' => $item]) }}">{{ $item }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="wave hero" style="background-image: url('{{ asset('assets/img/wave.svg') }}');"></div>
    </div>

    <!-- FEATURES SECTION -->
    <div class="bg_gray">
        <div class="container margin_60_40">
            <div class="main_title">
                <span><em></em></span>
                <h2>Kenapa Memilih Robodeliver?</h2>
                <p>Kami mengubah cara Anda memesan makanan dengan teknologi robot pintar.</p>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="box_how">
                        <figure><img src="{{ asset('assets/img/how_1.svg') }}" alt="Pesan Mudah" class="lazy"
                                width="150"></figure>
                        <h3>Pesan Mudah</h3>
                        <p>Proses pemesanan hanya dengan beberapa klik saja.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="box_how">
                        <figure><img src="{{ asset('assets/img/how_2.svg') }}" alt="Pengantaran Cepat" class="lazy"
                                width="150"></figure>
                        <h3>Pengantaran Cepat</h3>
                        <p>Robot pintar kami memastikan makanan Anda sampai dengan cepat.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="box_how">
                        <figure><img src="{{ asset('assets/img/how_3.svg') }}" alt="Nikmati Makanan" class="lazy"
                                width="150"></figure>
                        <h3>Nikmati Makanan</h3>
                        <p>Makanan sampai di depan pintu Anda, tetap segar dan lezat.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CALL TO ACTION -->
    <div class="cta_section" style="background: linear-gradient(to right, #ff6a00, #ee0979); color: white;">
        <div class="container text-center py-5">
            <h2 class="text-white">Buka Merchant Anda di Robodeliver</h2>
            <p>Gabung dengan jaringan kami untuk meningkatkan penjualan Anda dengan teknologi pengantaran otomatis
                berbasis robot.</p>
            <a href="{{ route('merchant.register') }}" class="btn_1 gradient">Ajukan Sekarang</a>
        </div>
    </div>

    <!-- RESTAURANTS SECTION -->
    <div class="container margin_60_40">
        <div class="main_title">
            <h2>Restoran Terbaik untuk Anda</h2>
            <p>Nikmati berbagai pilihan makanan dari restoran terbaik di kota Anda.</p>
        </div>
        <div class="row">
            @forelse($topMerchants as $merchant)
                <div class="col-lg-4">
                    <a href="{{ route('merchants.show', $merchant->id) }}" class="card_restaurant">
                        <figure>
                            <img src="{{ $merchant->image_url ?? asset('assets/img/restaurant_placeholder.jpg') }}"
                                alt="{{ $merchant->name }}" class="lazy img-fluid">
                        </figure>
                        <div class="restaurant_content">
                            <h3>{{ $merchant->name }}</h3>
                            <p>{{ $merchant->address }}</p>
                            <div class="score"><strong>{{ number_format($merchant->rating, 1) }}</strong></div>
                        </div>
                    </a>
                </div>
            @empty
                <p class="text-center">Belum ada restoran yang tersedia.</p>
            @endforelse
        </div>
    </div>

</x-home-layout>
