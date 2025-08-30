<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Store Locations - PrimeMart</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }

        /* Style for the map container */
        #map {
            height: 500px;
            width: 100%;
            border-radius: 0.5rem;
            border: 1px solid #dee2e6;
        }

        .location-card img {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>

<body>

    {{-- You would include your site's navigation bar here --}}
    @include('front-end.components.nav')

    <div class="container py-5">
        <!-- Page Header -->
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold">Our Store Locations</h1>
            <p class="lead text-muted">Find a PrimeMart near you. We're ready to serve you with the freshest products!</p>
        </div>

        <!-- Google Map Display -->
        <div class="card shadow-sm border-0 mb-5">
            <div class="card-body p-2">
                <div id="map"></div>
            </div>
        </div>


        <!-- Locations Grid -->
        <div class="row g-4">

            {{-- This loop will dynamically create a card for each location from your database --}}
            @isset($locations)
            @foreach ($locations as $location)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0 location-card">
                    <img src="{{ asset('storage/' . $location->image) }}" class="card-img-top" alt="{{ $location->name }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">{{ $location->name }}</h5>
                        <p class="card-text text-muted flex-grow-1">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            {{ $location->address }}
                        </p>
                        <a href="{{ $location->link }}" target="_blank" class="btn btn-primary mt-auto">View on Map</a>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <p class="text-center text-muted">No locations found.</p>
            @endisset

        </div>
    </div>

    {{-- You would include your site's footer here --}}
    @include('front-end.components.footer')

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Google Maps API Script -->
    {{-- IMPORTANT: Replace YOUR_API_KEY with your actual Google Maps API key --}}
    <script src="https://maps.googleapis.com/maps/api/js?key=   &callback=initMap" async defer></script>

    <script>
        function initMap() {
            // Convert the Laravel collection of locations to a JavaScript array
            const locations = @json($locations ?? []);

            // Default map center (Phnom Penh)
            const mapCenter = {
                lat: 11.562108,
                lng: 104.888535
            };

            // Create the map instance
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 12,
                center: mapCenter,
            });

            // Create a single InfoWindow to be reused for all markers
            const infoWindow = new google.maps.InfoWindow();

            // Loop through each location and create a marker
            locations.forEach(location => {
                const marker = new google.maps.Marker({
                    position: {
                        lat: parseFloat(location.latitude),
                        lng: parseFloat(location.longitude)
                    },
                    map: map,
                    title: location.name,
                });

                // Add a click listener to each marker
                marker.addListener("click", () => {
                    const content = `
                        <div style="max-width: 220px; text-align: left;">
                            <img src="/storage/${location.image}" alt="${location.name}" style="width: 100%; height: 120px; object-fit: cover; border-radius: 4px; margin-bottom: 10px;">
                            <h6 class="fw-bold mb-1">${location.name}</h6>
                            <p class="mb-2" style="font-size: 0.9em;">${location.address}</p>
                            <a href="${location.link}" target="_blank">View on Google Maps</a>
                        </div>
                    `;
                    infoWindow.setContent(content);
                    infoWindow.open(map, marker);
                });
            });
        }
    </script>
</body>

</html>