import { Loader } from "@googlemaps/js-api-loader";

const loader = new Loader({
    apiKey: import.meta.env.VITE_GOOGLE_MAPS_API_KEY,
    version: "weekly",
});

// function createInputSearch() {
//     const firstDivParent = document.createElement("div");
//     firstDivParent.classList.add("absolute");
//
//     const secondDivParent = document.createElement("div");
//     secondDivParent.classList.add(
//         "w-[200px]",
//         "sm:w-auto",
//         "relative",
//         "mr-auto",
//         "mt-3",
//         "sm:mt-0"
//     );
//
//     const icon = document.createElement("i");
//     icon.classList.add(
//         "w-4",
//         "h-4",
//         "absolute",
//         "my-auto",
//         "inset-y-0",
//         "ml-3",
//         "left-0",
//         "z-10",
//         "text-slate-500"
//     );
//     icon.setAttribute("data-lucide", "search");
//
//     const input = document.createElement("input");
//     input.classList.add("form-control", "w-full", "sm:w-64", "box", "py-10");
//     input.setAttribute("type", "text");
//     input.setAttribute("placeholder", "Cari lokasi");
//
//     secondDivParent.appendChild(icon);
//     secondDivParent.appendChild(input);
//     firstDivParent.appendChild(secondDivParent);
//
//     console.log(firstDivParent)
//
//     return firstDivParent;
// }

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

function geocodeLatLng(coordinate, geocoder) {
    coordinate = JSON.parse(coordinate);

    coordinate = {
        lat: parseFloat(coordinate.lat),
        lng: parseFloat(coordinate.lng),
    };

    return new Promise((resolve, reject) => {
        geocoder
            .geocode({ location: coordinate })
            .then((response) => {
                if (response.results[0]) {
                    resolve(response.results[0]); // Resolve with the geocoding result
                } else {
                    reject("No results found");
                }
            })
            .catch((e) => reject("Geocoder failed due to: " + e));
    });
}

//  Todo: create marker using marker clusterer
// Todo: only create markers & info that are visible on the map

loader.load().then(async () => {
    const { Map } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

    /** Change the first coordinate to the user's current location / to first lahan */

    // Random coordinates, will be changed with "move to current position"
    const defaultCoordinates = { lat: -6.1753924, lng: 106.8271528 };
    const map = new Map(document.getElementById("container-maps"), {
        center:
            seluruhLahan.length > 0
                ? {
                      lat: parseFloat(seluruhLahan[0].latitude),
                      lng: parseFloat(seluruhLahan[0].longitude),
                  }
                : defaultCoordinates,
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

    const geocoder = new google.maps.Geocoder();
    const infoWindow = new google.maps.InfoWindow();
    /** Move to current position */
    if (seluruhLahan.length == 0) {
        moveToCurrentPosition(map, infoWindow);
    }

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
        // Todo: add content string when the marker is clicked (to edit and delete dont forget :D)
        const contentString = `<div><strong>${lahan.nama_lahan}</strong></div>`;
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

        // Get Nama Lahan
        var namaLahan = lahan.new_nama;
        var string = document.querySelectorAll(`.${namaLahan}`);

        string.innerText = "Loading...";

        // Get Kecamatan & Kota
        if (string.length > 0) {
            geocodeLatLng(JSON.stringify(position), geocoder)
                .then((geocodeResult) => {
                    var kecamatan =
                        geocodeResult.address_components[3].short_name;
                    var kota = geocodeResult.address_components[4].long_name;

                    string.forEach((item) => {
                        item.innerText = `${kecamatan}, ${kota}`;
                    });
                })
                .catch((error) => {
                    console.error("Geocoding error:", error);
                    string.forEach((item) => {
                        item.innerText = "Lokasi tidak ditemukan";
                    });
                });
        }

        // Place Marker
        var marker = new AdvancedMarkerElement({
            map,
            position: position,
            title: lahan.nama_lahan,
        });

        marker.addListener("click", () => {
            infoWindows[index].open(map, marker);
        });
    });

    /** Move map to the selected lahan */
    const lokasi_lahan = document.querySelectorAll(".lokasi-lahan");
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
