<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
    <title>PrimeMart - Edit Location</title>

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
                        <h4 class="page-title">Edit Location</h4>
                    </div>
                    <div class="col-sm-4 col-6 text-right m-b-20">
                        <a href="{{ route('dashboard.location.index') }}" class="btn btn-primary btn-rounded float-right">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form action="{{ route('dashboard.location.update', $location->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>Location Name</label>
                                <input class="form-control" type="text" name="name" value="{{ $location->name }}" required>
                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" name="address" rows="3" required>{{ $location->address }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Current Image</label>
                                <input class="form-control" name="image" type="file" id="file-input" accept="image/*">
                                <small class="form-text text-muted">Only upload a file if you want to replace the current image.</small>
                            </div>

                            <div class="form-group">
                                <label>Map Link</label>
                                <input class="form-control" type="url" name="link" value="{{ $location->link }}">
                            </div>

                            <!-- Map Button -->
                            <div class="form-group">
                                <label>Location Coordinates</label>
                                <div>
                                    <button type="button" id="showMapBtn" class="btn btn-info">Update Location Pin</button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Latitude</label>
                                        <input id="latitude" class="form-control" type="number" step="any" name="latitude" value="{{ $location->latitude }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Longitude</label>
                                        <input id="longitude" class="form-control" type="number" step="any" name="longitude" value="{{ $location->longitude }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="m-t-20 text-center">
                                <button type="submit" class="btn btn-primary submit-btn">Update Location</button>
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
        let map, marker;

        const showMapBtn = document.getElementById('showMapBtn');
        const mapModal = document.getElementById('mapModal');
        const closeMapBtn = document.getElementById('closeMapBtn');

        // Show modal and initialize map
        showMapBtn.addEventListener('click', async () => {
            mapModal.style.display = 'flex';
            if (!map) {
                await initMap();
            }
        });

        // Close modal
        closeMapBtn.addEventListener('click', () => {
            mapModal.style.display = 'none';
        });

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

            const currentLocation = {
                lat: parseFloat(latitudeInput.value) || 11.5564,
                lng: parseFloat(longitudeInput.value) || 104.9282
            };

            map = new Map(document.getElementById("map"), {
                center: currentLocation,
                zoom: 15,
                mapId: "DEMO_MAP_ID",
            });

            marker = new AdvancedMarkerElement({
                map: map,
                position: currentLocation,
                title: "Pinned Location",
                gmpDraggable: true
            });

            map.addListener("click", (e) => {
                placeMarker(e.latLng);
            });

            marker.addListener("dragend", (e) => {
                placeMarker(e.latLng);
            });
        }

        function placeMarker(location) {
            marker.position = location;
            document.getElementById("latitude").value = location.lat().toFixed(8);
            document.getElementById("longitude").value = location.lng().toFixed(8);
        }

        function placeMarker(location) {
            marker.position = location;
            document.getElementById("latitude").value = location.lat().toFixed(8);
            document.getElementById("longitude").value = location.lng().toFixed(8);
        }
    </script>

    <!-- Load Google Maps API -->
    <script async
        src="https://maps.googleapis.com/maps/api/js?key=&libraries=maps,marker">
    </script>

</body>

</html>