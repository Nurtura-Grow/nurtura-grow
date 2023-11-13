import { Loader } from "@googlemaps/js-api-loader";

const loader = new Loader({
    apiKey: import.meta.env.VITE_GOOGLE_MAPS_API_KEY,
    version: "weekly",
    libraries: ["places"],
});

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(
        browserHasGeolocation
            ? "Error: The Geolocation service failed."
            : "Error: Your browser doesn't support geolocation."
    );
    infoWindow.open(map);
}

function moveToCurrentPosition(map, infoWindow) {
    // Try HTML5 geolocation.
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };

                infoWindow.setPosition(pos);
                infoWindow.setContent("Current Location");
                infoWindow.open(map);
                map.setCenter(pos);
                map.setZoom(16);
            },
            () => {
                handleLocationError(true, infoWindow, map.getCenter());
            }
        );
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }
}

loader.load().then(async () => {
    const { Map } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

    /** Change the first coordinate to the user's current location / to first lahan */
    var koordinat;
    if (lahan != null) {
        koordinat = {
            lat: parseFloat(lahan.latitude),
            lng: parseFloat(lahan.longitude),
        };
    } else if (seluruhLahan.length > 0) {
        koordinat = {
            lat: parseFloat(seluruhLahan[0].latitude),
            lng: parseFloat(seluruhLahan[0].longitude),
        };
    } else {
        // Random coordinate, will be changed into user's current location/first lahan/lahan edited
        koordinat = { lat: -6.1753924, lng: 106.8271528 };
    }

    const map = new Map(document.getElementById("container-maps"), {
        center: koordinat,
        zoom: 10,
        mapId: "9505b7cedf2238ff",
        zoomControl: true,
        scaleControl: true,
        streetViewControl: true,
        rotateControl: true,
        fullscreenControl: true,
        mapTypeControl: true,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            position: google.maps.ControlPosition.LEFT_BOTTOM,
        },
    });

    const infoWindow = new google.maps.InfoWindow();
    /** Move to current position */
    if (seluruhLahan.length == 0) {
        moveToCurrentPosition(map, infoWindow);
    }

    /** Search Input */
    // map.controls[google.maps.ControlPosition.TOP_LEFT].push(
    //     createInputSearch()
    // );

    /** Auto Complete */
    const input = document.querySelector("#cari-lokasi");
    const options = {
        fields: ["formatted_address", "geometry", "name"],
        strictBounds: false,
    };

    const autocomplete = new google.maps.places.Autocomplete(input, options);
    autocomplete.bindTo("bounds", map);

    autocomplete.addListener("place_changed", () => {
        const place = autocomplete.getPlace();

        if (!place.geometry || !place.geometry.location) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("Tidak ada data tersedia untuk: '" + place.name + "'");
            return;
        }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
    });

    /** Button current position, embed to the map */
    const locationButton = document.createElement("button");

    locationButton.innerHTML = `<i class="fa-solid fa-location-crosshairs"></i>`;
    locationButton.classList.add("btn", "bg-white", "shadow", "mr-3");

    // Embed the button to the map display
    map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(locationButton);

    locationButton.addEventListener("click", () => {
        moveToCurrentPosition(map, infoWindow);
    });

    // map.controls[google.maps.ControlPosition.TOP_LEFT].push(inputSearch);

    /** Center Marker */
    const centerMarker = new google.maps.Marker({
        position: map.getCenter(),
        map: map,
        title: "Center Marker",
        draggable: true, // Make the marker draggable
    });

    /** Event listener for marker dragend event */
    google.maps.event.addListener(centerMarker, "dragend", function () {
        centerMarker.setMap(null); // Remove the marker from the map
    });

    /** Get Center Coordinate when the map is moved */
    google.maps.event.addListener(map, "center_changed", function () {
        var center = this.getCenter();
        var latitude = parseFloat(center.lat()).toFixed(6);
        var longitude = parseFloat(center.lng()).toFixed(6);

        const latitudeInput = document.getElementById("latitude-input");
        const longitudeInput = document.getElementById("longitude-input");

        if (latitudeInput == null || longitudeInput == null) return;

        latitudeInput.value = latitude;
        longitudeInput.value = longitude;

        centerMarker.setPosition(center);
    });

    /** Create Info windows (pop up when the marker is clicked) */
    const infoWindows = seluruhLahan.map((lahan) => {
        const contentString = `<div class="w-auto xl:w-[250px]">
            <strong class="text-lg font-bold">${lahan.nama_lahan}</strong>
            <p class="mb-4 text-justify text-slate-600 font-semibold">${lahan.deskripsi}</p>
            <p class="mb-4 text-justify text-black">${lahan.alamat}</p>

            <a target="_blank" href="https://www.google.com/maps/place/${lahan.latitude},${lahan.longitude}" class="btn bg-info px-2 w-full"><i class="fa-solid fa-map w-4 h-4 mr-2"></i>Buka di google maps</a>
            <a href="lahan/${lahan.id_lahan}/edit" class="btn btn-primary mt-2 px-2 w-full"><i class="fa-solid fa-pencil w-4 h-4 mr-2"></i>Ubah</a>
            <button type="button" class="btn btn-danger px-2 mt-2 w-full delete-lahan" onclick="deleteModal(${lahan.id_lahan})" data-tw-toggle="modal" data-tw-target="#delete-modal"><i class="fa-solid fa-trash w-4 h-4 mr-2"></i>Hapus</button>
        </div>`;


        return new google.maps.InfoWindow({
            content: contentString,
        });
    });

    /** Logic for every lahan */
    seluruhLahan.forEach((lahan, index) => {
        const position = {
            lat: parseFloat(lahan.latitude),
            lng: parseFloat(lahan.longitude),
        };

        // Place Marker
        var marker = new AdvancedMarkerElement({
            map,
            position: position,
            title: lahan.nama_lahan,
            draggable: false,
        });

        marker.addListener("click", () => {
            infoWindows[index].open(map, marker);
        });
    });

    /** Move map to the selected lahan (Small Screen) */
    const container = document.getElementById("carousel-container");
    if (container) {
        container.addEventListener("click", function (event) {
            const targetElement = event.target.closest(".lokasi-lahan");

            if (targetElement) {
                const koordinat = JSON.parse(targetElement.getAttribute("data-koordinat"));

                const koordinatLatLng = {
                    lat: parseFloat(koordinat.lat),
                    lng: parseFloat(koordinat.lng),
                };

                map.setCenter(koordinatLatLng);
                map.setZoom(16);
            }
        });
    }

    /** Move map to the selected lahan (Big Screen) */
    var lokasi_lahan = document.querySelectorAll(".lokasi-lahan");
    lokasi_lahan.forEach((lahan) => {
        lahan.addEventListener("click", function () {
            const koordinat = JSON.parse(this.getAttribute("data-koordinat"));

            const koordinatLatLng = {
                lat: parseFloat(koordinat.lat),
                lng: parseFloat(koordinat.lng),
            };

            map.setCenter(koordinatLatLng);
            map.setZoom(16);
        });
    });
});
