<x-home-layout title="Daftar Restoran">
    <x-breadcrumb :title="'Daftar Restoran'" :subtitle="'Gabung di Robodeliver'" />
    <div class="container margin_60_40">
        <div class="main_title">
            <h2>Daftarkan Restoran Anda</h2>
            <p>Gabung dengan Robodeliver dan tingkatkan penjualan dengan teknologi pengantaran otomatis.</p>
        </div>

        <form action="{{ route('merchant.store') }}" method="POST" onsubmit="return validateForm()">
            @csrf

            <div class="form-group">
                <label for="name">Nama Restoran</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="address">Alamat</label>
                <input type="text" name="address" id="address" class="form-control" placeholder="Cari alamat..." value="{{ old('address') }}" required>
                @error('address')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Map Container -->
            <div id="map" style="width: 100%; height: 300px; margin-bottom: 20px;"></div>

            <!-- Hidden Latitude and Longitude Fields -->
            <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
            <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">

            @error('latitude')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            @error('longitude')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="form-group">
                <label for="description">Deskripsi Restoran (Opsional)</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn_1 gradient full-width">Daftar</button>
        </form>
    </div>

    <!-- Google Maps Script -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places"></script>
    <script>
        let map, marker;

        function initialize() {
            const input = document.getElementById('address');
            const autocomplete = new google.maps.places.Autocomplete(input);
            const defaultLocation = { lat: -6.200000, lng: 106.816666 }; // Default: Jakarta

            // Initialize the map
            map = new google.maps.Map(document.getElementById('map'), {
                center: defaultLocation,
                zoom: 13,
            });

            // Add a draggable marker to the map
            marker = new google.maps.Marker({
                position: defaultLocation,
                map: map,
                draggable: true,
            });

            // Set initial latitude and longitude
            document.getElementById('latitude').value = defaultLocation.lat;
            document.getElementById('longitude').value = defaultLocation.lng;

            // Update hidden fields when the marker is dragged
            google.maps.event.addListener(marker, 'dragend', function() {
                const position = marker.getPosition();
                updateHiddenFields(position);
            });

            // Update marker and hidden fields when a place is selected
            autocomplete.addListener('place_changed', function () {
                const place = autocomplete.getPlace();
                if (place.geometry) {
                    const location = place.geometry.location;

                    map.setCenter(location);
                    marker.setPosition(location);

                    updateHiddenFields(location);
                }
            });
        }

        function updateHiddenFields(location) {
            document.getElementById('latitude').value = location.lat();
            document.getElementById('longitude').value = location.lng();
        }

        function validateForm() {
            const lat = document.getElementById('latitude').value;
            const lng = document.getElementById('longitude').value;

            if (!lat || !lng) {
                alert('Silakan pilih lokasi yang valid pada peta.');
                return false;
            }
            return true;
        }

        // Initialize the map on page load
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</x-home-layout>
