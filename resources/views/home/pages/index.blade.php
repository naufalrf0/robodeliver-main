@php
    $heroData = [
        'title' => 'Delivery or Takeaway Food',
        'subtitle' => 'The best restaurants at the best price',
        'trending' => ['Sushi', 'Burger', 'Chinese', 'Pizza'],
        'formAction' => route('order.food')
    ];
@endphp

<x-home-layout 
    :title="'Beranda - Robodeliver'" 
    :metaDescription="'Discover the best food and restaurants with Robodeliver.'" 
    :metaAuthor="'Robodeliver Inc.'">
    
    <!-- START SLIDER -->
    <div class="hero_single version_2 kenburns_slider" style="background: none;">
        <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
            <div class="container">
                <div class="row justify-content-lg-start justify-content-md-center">
                    <div class="col-xl-7 col-lg-8">
                        <h1>{{ $heroData['title'] }}</h1>
                        <p>{{ $heroData['subtitle'] }}</p>
                        <form method="post" action="{{ url($heroData['formAction']) }}">
                            <div class="row g-0 custom-search-input">
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <input class="form-control no_border_r" type="text" placeholder="What are you looking for...">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <button class="btn_1 gradient" type="submit">Search</button>
                                </div>
                            </div>
                            <!-- /row -->
                            <div class="search_trends">
                                <h5>Trending:</h5>
                                <ul>
                                    @foreach($heroData['trending'] as $item)
                                        <li><a href="#0">{{ $item }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /row -->
            </div>
        </div>
        <div class="wave hero" style="background-image: url('{{ asset('assets/img/wave.svg') }}');"></div>
    </div>
    
    <!-- END REVOLUTION SLIDER -->

    <div class="shape_element_2">
        <div class="container margin_30_40">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="box_how">
                                <figure><img src="{{ asset('assets/img/lazy-placeholder-100-100-white.png') }}" data-src="{{ asset('assets/img/how_1.svg') }}" alt="" width="150" height="167" class="lazy"></figure>
                                <h3>Pesan Mudah</h3>
                                <p>Proses pemesanan yang mudah dan cepat, cukup beberapa langkah sederhana.</p>
                            </div>
                            <div class="box_how">
                                <figure><img src="{{ asset('assets/img/lazy-placeholder-100-100-white.png') }}" data-src="{{ asset('assets/img/how_2.svg') }}" alt="" width="130" height="145" class="lazy"></figure>
                                <h3>Pengantaran Cepat</h3>
                                <p>Makanan Anda akan sampai dengan cepat dan tetap hangat.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 align-self-center">
                            <div class="box_how">
                                <figure><img src="{{ asset('assets/img/lazy-placeholder-100-100-white.png') }}" data-src="{{ asset('assets/img/how_3.svg') }}" alt="" width="150" height="132" class="lazy"></figure>
                                <h3>Nikmati Makanan</h3>
                                <p>Nikmati makanan lezat di rumah Anda tanpa repot.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1 align-self-center">
                    <div class="intro_txt">
                        <div class="main_title">
                            <span><em></em></span>
                            <h2>Cara Kerja Robodeliver</h2>
                        </div>
                        <p class="lead">Robodeliver mempermudah pengalaman pemesanan dan pengantaran makanan Anda.</p>
                        <p>Kami memastikan makanan Anda sampai dengan cepat, aman, dan tetap segar.</p>
                        <p><a href="https://www.youtube.com/watch?v=MO7Hi_kBBBg" class="btn_1 medium gradient pulse_bt plus_icon btn_play mt-2">Putar Video Promo<i class="arrow_triangle-right"></i></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-home-layout>
