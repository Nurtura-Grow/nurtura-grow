import { defineConfig, normalizePath } from "vite";
import laravel from "laravel-vite-plugin";
import { resolve } from "path";

export default defineConfig({
    resolve: {
        alias: {
            "@": normalizePath(resolve(__dirname, "resource")),
            "$": "jQuery",
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
            ],
            refresh: true,
        }),
    ],
});
