<x-admin-layout :title="'Detail Merchant - Robodeliver'" :metaDescription="'Detail Merchant Admin Robodeliver.'">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5>Detail Merchant</h5>
            </div>
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $merchant->name }}</p>
                <p><strong>Alamat:</strong> {{ $merchant->address }}</p>
                <p><strong>Status:</strong> 
                    @if ($merchant->status === 'active')
                        <span class="badge bg-success">Aktif</span>
                    @elseif ($merchant->status === 'pending')
                        <span class="badge bg-warning text-dark">Pending</span>
                    @else
                        <span class="badge bg-danger">Ditolak</span>
                    @endif
                </p>
                <p><strong>Deskripsi:</strong> {{ $merchant->description }}</p>
                <p><strong>Latitude:</strong> {{ $merchant->latitude }}</p>
                <p><strong>Longitude:</strong> {{ $merchant->longitude }}</p>

                {{-- Google Maps Section --}}
                <div id="map" style="width: 100%; height: 400px;" class="mt-4"></div>

                <div class="mt-3">
                    @if ($merchant->status === 'pending')
                        <a href="{{ route('admin.merchants.accept', $merchant->id) }}" class="btn btn-success">Terima</a>
                        <a href="{{ route('admin.merchants.reject', $merchant->id) }}" class="btn btn-danger">Tolak</a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Products Section --}}
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <h5>Produk Merchant</h5>
            </div>
            <div class="card-body">
                @if ($merchant->products->isEmpty())
                    <p class="text-center">Merchant ini belum memiliki produk.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($merchant->products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->stock }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    {{-- Google Maps API --}}
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const latitude = {{ $merchant->latitude }};
            const longitude = {{ $merchant->longitude }};
            const mapOptions = {
                zoom: 15,
                center: { lat: latitude, lng: longitude },
            };

            const map = new google.maps.Map(document.getElementById('map'), mapOptions);
            new google.maps.Marker({
                position: { lat: latitude, lng: longitude },
                map: map,
                title: '{{ $merchant->name }}',
            });
        });
    </script>
</x-admin-layout>
