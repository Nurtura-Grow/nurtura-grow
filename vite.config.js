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
                // Compiled Resources
                "resources/css/app.css",
                "resources/js/main.js",
                "resources/js/app.js",

                // Pages
                "resources/js/pages/datatable.js",

                // Dashboard
                "resources/js/pages/dashboard/button.js",
                "resources/js/pages/dashboard/chart.js",

                // Data Manual
                "resources/js/pages/data-manual/waktuMulaiSelesai",
                "resources/js/pages/data-manual/getPenanamanTanggalTanam.js",

                // Lahan
                "resources/js/pages/lahan/googleMaps.js",
                "resources/js/pages/lahan/searchLahan.js",

                // Penanaman
                "resources/js/pages/penanaman/litepicker.js",
                // "resources/js/pages/testing.js",
            ],
            refresh: true,
        }),
    ],
});
