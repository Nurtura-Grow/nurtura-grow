import { Loader } from "@googlemaps/js-api-loader";
import { post } from "jquery";

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

loader.load().then(async () => {
    const { Map } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

    // const inputSearch = createInputSearch();

    const map = new Map(document.getElementById("container-maps"), {
        center: { lat: -7.257587749467159, lng: 112.74779134028901 },
        zoom: 16,
        mapId: "9505b7cedf2238ff",
        zoomControl: true,
        scaleControl: true,
        streetViewControl: true,
        rotateControl: true,
        fullscreenControl: true,
        mapTypeControl: true,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            position: google.maps.ControlPosition.BOTTOM_LEFT,
        },
    });

    // map.controls[google.maps.ControlPosition.TOP_LEFT].push(inputSearch);

    seluruhLahan.forEach((lahan) => {
        const position = {
            lat: parseFloat(lahan.latitude),
            lng: parseFloat(lahan.longitude),
        };

        new AdvancedMarkerElement({
            map,
            position: position,
            title: lahan.nama_lahan,
        });
    });
});
