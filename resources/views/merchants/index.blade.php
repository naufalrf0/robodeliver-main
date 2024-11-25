<x-home-layout title="Pesan Makanan - RoboDeliver">
    <x-breadcrumb :title="'Restoran Terdaftar'" :subtitle="'Restoran'" />

    <div class="page_header element_to_stick">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $merchants->total() }} Restoran Terdaftar</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container margin_30_20">
        @if ($merchants->isEmpty())
            <p class="text-center">Tidak ada restoran yang ditemukan.</p>
        @else
            <div class="row isotope-wrapper">
                @foreach ($merchants as $merchant)
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 isotope-item">
                        <div class="strip">
                            <figure>
                                <img src="{{ $merchant->image_url ?? asset('img/default-merchant.jpg') }}" alt="{{ $merchant->name }}" class="img-fluid">
                                <a href="{{ route('merchants.show', $merchant->id) }}" class="strip_info">
                                    <div class="item_title">
                                        <h3>{{ $merchant->name }}</h3>
                                        <small>{{ $merchant->address }}</small>
                                    </div>
                                </a>
                            </figure>
                            <ul>
                                <li>
                                    <div class="score"><strong>{{ number_format($merchant->rating, 1) }}</strong></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="pagination_fg">
                {{ $merchants->links() }}
            </div>
        @endif
    </div>
</x-home-layout>
