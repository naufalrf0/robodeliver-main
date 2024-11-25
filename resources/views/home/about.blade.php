<x-home-layout :title="'Kontak - Robodeliver'" :metaDescription="'Temukan makanan dan restoran terbaik bersama Robodeliver.'" :metaAuthor="'Robodeliver Inc.'">
    @push('styles')
        <link href="{{ asset('assets/css/contacts.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    @endpush

    <x-breadcrumb :title="'Tentang Robodeliver'" :subtitle="'Tentang Kami'" />

    <div class="container margin_30_20">            
        <div class="main_title center">
            <span><em></em></span>
            <h2>Tentang Robodeliver</h2>
            <p>Informasi Robodeliver</p>
        </div>

        <div class="row justify-content-center align-items-center add_bottom_15">
            <div class="col-lg-6">
                <div class="box_about">
                    <h3>Apa itu Robodeliver?</h3>
                    <p>Robodeliver merupakan sebuah aplikasi inovatif yang memudahkan pengguna untuk memesan berbagai macam makanan dengan pengantaran otomatis menggunakan robot. Robodeliver merupakan situs untuk mempromosikan makanan dari berbagai merchant lokal dan mengantarkan pesanan ke lokasi pemesan oleh robot pintar.</p>
                </div>
            </div>
            <div class="col-lg-6 text-center d-none d-lg-block">
                <img src="{{ asset('assets/img/logo.png') }}" alt="" class="img-fluid" width="250" height="250">
            </div>
        </div>

        <div class="row justify-content-center align-items-center add_bottom_15">
            <div class="col-lg-6 text-center d-none d-lg-block">
                <img src="https://poodies.candrawjy.my.id/assets/img/why-us.svg" alt="" class="img-fluid" width="250" height="250">
            </div>
            <div class="col-lg-6">
                <div class="box_about">
                    <h3>Mengapa Harus Robodeliver?</h3>
                    <p>Robodeliver menyediakan layanan pesan-antar makanan menggunakan robot dengan fitur real-time pelacakan robot. Pengguna juga dapat merasakan pengalaman unik dan efisien dari layanan antar makanan menggunakan robot, memberikan kenyamanan tanpa batas dengan pengantaran cepat, aman, dan futuristik melalui teknologi robotik canggih.</p>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('assets/js/common_scripts.min.js') }}"></script>
        <script src="{{ asset('assets/js/common_func.js') }}"></script>
        <script src="{{ asset('assets/validate.js') }}"></script>
    @endpush
</x-home-layout>
