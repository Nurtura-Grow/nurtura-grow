import { defineConfig, normalizePath } from "vite";
import laravel from "laravel-vite-plugin";
import { resolve } from "path";

export default defineConfig({
    resolve: {
        alias: {
            "@": normalizePath(resolve(__dirname, "resource")),
            "$": "jQuery",
            "~flatpickr": resolve(__dirname, "node_modules/flatpickr"),
        },
    },

    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/main.js",
                "resources/js/app.js",

                "resources/js/pages/datatable.js",
                "resources/js/pages/googleMaps.js",
                "resources/js/pages/searchLahan.js",
                "resources/js/pages/getPenanamanTanggalTanam.js",
                "resources/js/pages/litepicker.js",
                "resources/js/pages/flatpickr.js",
                // "resources/js/pages/testing.js",
            ],
            refresh: true,
        }),
    ],
});
