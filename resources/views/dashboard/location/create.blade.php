<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
    <title>PrimeMart - Add Location</title>

    <!--Style-->
    @include('dashboard.components.style')

    {{-- Scripts for Bootstrap functionality --}}
    <script src="{{ asset('js/dashboard/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/popper.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/bootstrap.min.js') }}"></script>

    {{-- Custom styles for the map modal --}}
    <style>
        #mapModal {
            display: none;
            position: fixed;
            z-index: 1050;
            /* Higher than Bootstrap's default modal z-index */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
        }

        #mapModalContent {
            background-color: #fefefe;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 800px;
            border-radius: 8px;
            position: relative;
        }
    </style>
</head>

<body>
    <div class="main-wrapper">

        <!-- Header -->
        @include('dashboard.components.header')

        <!-- Sidebar -->
        @include('dashboard.components.sidebar')

        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-8 col-6">
                        <h4 class="page-title">Add Location</h4>
                    </div>
                    <div class="col-sm-4 col-6 text-right m-b-20">
                        <a href="{{ route('dashboard.location.index') }}" class="btn btn-primary btn-rounded float-right"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form action="{{ route('dashboard.location.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label>Location Name</label>
                                <input class="form-control" type="text" name="name" required>
                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" name="address" rows="3" required></textarea>
                            </div>

                            <div class="form-group">
                                <label>Image</label>
                                <input class="form-control" type="file" name="image" required>
                            </div>

                            <div class="form-group">
                                <label>Website/Map Link</label>
                                <input class="form-control" type="url" name="link">
                            </div>

                            <!-- Map Button -->
                            <div class="form-group">
                                <label>Location Coordinates</label>
                                <div>
                                    <button type="button" id="showMapBtn" class="btn btn-info">Pin Location on Map</button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Latitude</label>
                                        <input id="latitude" class="form-control" type="number" step="any" name="latitude" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Longitude</label>
                                        <input id="longitude" class="form-control" type="number" step="any" name="longitude" required>
                                    </div>
                                </div>
                            </div>

                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Create Location</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Modal -->
    <div id="mapModal">
        <div id="mapModalContent">
            <h5 class="text-center">Click or drag the pin to set the location</h5>
            <div id="map" style="height: 50vh; width: 100%; border-radius: 8px; margin-top: 15px; margin-bottom: 15px;"></div>
            <div class="text-center">
                <button type="button" id="closeMapBtn" class="btn btn-danger">Done</button>
            </div>
        </div>
    </div>

    <div class="sidebar-overlay" data-reff=""></div>

    <!-- Google Maps Script -->
    <script>
        let map;
        let marker;
        let mapInitialized = false;

        // --- MODAL LOGIC ---
        const showMapBtn = document.getElementById('showMapBtn');
        const mapModal = document.getElementById('mapModal');
        const closeMapBtn = document.getElementById('closeMapBtn');

        // Show the modal and initialize the map on first click
        showMapBtn.addEventListener('click', () => {
            mapModal.style.display = 'flex';
            if (!mapInitialized) {
                initMap();
                mapInitialized = true;
            }
        });

        // Hide the modal with the close button
        closeMapBtn.addEventListener('click', () => {
            mapModal.style.display = 'none';
        });

        // Hide the modal when clicking outside the content area
        mapModal.addEventListener('click', (event) => {
            if (event.target === mapModal) {
                mapModal.style.display = 'none';
            }
        });


        // --- GOOGLE MAPS LOGIC ---
        async function initMap() {
            const latitudeInput = document.getElementById("latitude");
            const longitudeInput = document.getElementById("longitude");

            const {
                Map
            } = await google.maps.importLibrary("maps");
            const {
                AdvancedMarkerElement
            } = await google.maps.importLibrary("marker");

            const defaultLocation = {
                lat: 11.5564,
                lng: 104.9282
            };

            map = new Map(document.getElementById("map"), {
                center: defaultLocation,
                zoom: 13,
                mapId: "DEMO_MAP_ID",
            });

            marker = new AdvancedMarkerElement({
                map: map,
                position: defaultLocation,
                title: "Pinned Location",
                gmpDraggable: true
            });

            // Set initial input values if they are empty
            if (!latitudeInput.value || !longitudeInput.value) {
                latitudeInput.value = defaultLocation.lat.toFixed(8);
                longitudeInput.value = defaultLocation.lng.toFixed(8);
            }

            map.addListener("click", (e) => {
                placeMarker(e.latLng);
            });

            marker.addListener('dragend', (e) => {
                placeMarker(e.latLng);
            });
        }

        function placeMarker(location) {
            marker.position = location;
            document.getElementById("latitude").value = location.lat().toFixed(8);
            document.getElementById("longitude").value = location.lng().toFixed(8);
        }

        // Note: We don't call initMap here anymore. It's called when the modal is first opened.
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap&libraries=maps,marker" defer></script>

</body>

</html>