<x-auth-layout :title="'Complete Profile - Robodeliver'" :metaDescription="'Complete your profile on Robodeliver'" :metaAuthor="'Robodeliver Inc.'">
    <h1 class="m-3 fs-4 text-center fw-semibold">Lengkapi Profil Anda</h1>

    <form method="POST" action="{{ route('completeprofile') }}" autocomplete="off" onsubmit="return validateForm()">
        @csrf
        <div class="form-group">
            <input class="form-control" type="text" name="phone_number" placeholder="Nomor Telepon" required>
            <i class="icon_mobile"></i>
        </div>
        <div class="form-group">
            <input id="address" class="form-control" type="text" name="address" placeholder="Cari Alamat" required>
            <i class="icon_map_alt"></i>
        </div>

        <!-- Map container -->
        <div id="map" style="width: 100%; height: 300px; margin-bottom: 20px;"></div>

        <!-- Hidden fields for latitude and longitude -->
        <input id="latitude" type="hidden" name="latitude" required>
        <input id="longitude" type="hidden" name="longitude" required>

        <button type="submit" class="btn_1 gradient full-width">Lengkapi Profil</button>
    </form>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places"></script>
    <script>
        let map, marker;

        function initialize() {
            const input = document.getElementById('address');
            const autocomplete = new google.maps.places.Autocomplete(input);
            const defaultLocation = { lat: -6.200000, lng: 106.816666 }; // Default: Jakarta

            map = new google.maps.Map(document.getElementById('map'), {
                center: defaultLocation,
                zoom: 13,
            });

            marker = new google.maps.Marker({
                position: defaultLocation,
                map: map,
                draggable: true,
            });

            // Set initial values
            document.getElementById('latitude').value = defaultLocation.lat;
            document.getElementById('longitude').value = defaultLocation.lng;

            // Update hidden fields when marker is dragged
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
                alert('Please select a valid location from the map.');
                return false;
            }
            return true;
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</x-auth-layout>
