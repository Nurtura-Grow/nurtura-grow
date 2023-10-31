import { Loader } from "@googlemaps/js-api-loader";

console.log("GOOGLE_MAPS_API_KEY", import.meta.env.VITE_GOOGLE_MAPS_API_KEY);

const loader = new Loader({
    apiKey: import.meta.env.VITE_GOOGLE_MAPS_API_KEY,
    version: "weekly",
});

loader.load().then(async () => {
    const { Map } = await google.maps.importLibrary("maps");

    map = new Map(document.getElementById("container-maps"), {
        center: { lat: -34.397, lng: 150.644 },
        zoom: 8,
    });
});
