import { defineConfig, normalizePath } from "vite";
import laravel from "laravel-vite-plugin";
import { resolve } from "path";

export default defineConfig({
    resolve: {
        alias: {
            "@": normalizePath(resolve(__dirname, "resource")),
            $: "jQuery",
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
                'resources/js/jquery.js',

                // Pages
                "resources/js/pages/datatable.js",
                'resources/js/datatable/jquery.dataTables.js',
                'resources/js/datatable/responsive.js',

                // Auth
                "resources/js/auth/verifikasi-otp.js",

                // Dashboard
                "resources/js/pages/dashboard/litepickr.js",
                "resources/js/pages/dashboard/chart.js",

                // Data Manual
                "resources/js/pages/data-manual/waktuMulaiSelesai.js",
                "resources/js/pages/data-manual/getPenanamanTanggalTanam.js",
                "resources/js/pages/data-manual/pengairan-pemupukan.js",
                "resources/js/pages/data-manual/pengairan.js",
                "resources/js/pages/data-manual/pemupukan.js",

                // Lahan
                "resources/js/pages/lahan/googleMaps.js",
                "resources/js/pages/lahan/searchLahan.js",

                // Penanaman
                "resources/js/pages/penanaman/litepicker.js",
                // "resources/js/pages/testing.js",

                // Riwayat
                "resources/js/pages/riwayat/index.js",
                "resources/js/pages/riwayat/data-sensor.js",
                "resources/js/pages/riwayat/litepicker.js",
            ],
            refresh: true,
        }),
    ],
});
