<x-home-layout title="{{ $merchant->name }} - RoboDeliver">
    <main>
        <div class="container margin_30_20">
            <div class="promo">
                <h3>{{ $merchant->name }}</h3>
                <p>{{ $merchant->description }}</p>
                <p><strong>Address:</strong> {{ $merchant->address }}</p>
                <p><strong>Rating:</strong> {{ number_format($merchant->rating, 1) }}</p>
            </div>

            <div id="map" style="width: 100%; height: 300px;"></div>
        </div>
    </main>

    <script>
        function initMap() {
            const location = { lat: {{ $merchant->latitude }}, lng: {{ $merchant->longitude }} };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 14,
                center: location,
            });
            new google.maps.Marker({
                position: location,
                map: map,
            });
        }

        document.addEventListener("DOMContentLoaded", function () {
            initMap();
        });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}"></script>
</x-home-layout>
