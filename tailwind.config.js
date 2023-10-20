/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                "root": {
                    "primary": "87 180 146", // Green Tosca
                    "secondary": "0 38 35", // Dark Green
                    "success": "132 204 22",
                    "info": "6 182 212",
                    "warning": "250 204 21",
                    "pending": "249 115 22",
                    "danger": "220 38 38",
                    "light": "241 245 249",
                    "dark": "0 38 35",
                    "slate-50": "248 250 252",
                    "slate-100": "241 245 249",
                    "slate-200": "226 232 240",
                    "slate-300": "203 213 225",
                    "slate-400": "148 163 184",
                    "slate-500": "100 116 139",
                    "slate-600": "71 85 105",
                    "slate-700": "51 65 85",
                    "slate-800": "30 41 59",
                    "slate-900": "15 23 42",
                },
                "dark": {
                    "primary": "29 78 216",
                    "slate-500": "148 163 184",
                    "darkmode-50": "87 103 132",
                    "darkmode-100": "74 90 121",
                    "darkmode-200": "65 81 114",
                    "darkmode-300": "53 69 103",
                    "darkmode-400": "48 61 93",
                    "darkmode-500": "41 53 82",
                    "darkmode-600": "40 51 78",
                    "darkmode-700": "35 45 69",
                    "darkmode-800": "27 37 59",
                    "darkmode-900": "15 23 42",
                },
                "theme-1": {
                    "primary": "6 78 59",
                    "secondary": "226 232 240",
                    "success": "5 150 105",
                    "info": "6 182 212",
                    "warning": "250 204 21",
                    "pending": "245 158 11",
                    "danger": "225 29 72",
                    "light": "241 245 249",
                    "dark": "30 41 59",
                    "dark-primary": "6 95 70"
                },
                "theme-2": {
                    "primary": "30 58 138",
                    "secondary": "226 232 240",
                    "success": "13 148 136",
                    "info": "6 182 212",
                    "warning": "245 158 11",
                    "pending": "249 115 22",
                    "danger": "185 28 28",
                    "light": "241 245 249",
                    "dark": "30 41 59",
                    "dark-primary": "30 64 175"
                },
                "theme-3":{
                    "primary": "22 78 99",
                    "secondary": "226 232 240",
                    "success": "13 148 136",
                    "info": "6 182 212",
                    "warning": "245 158 11",
                    "pending": "217 119 6",
                    "danger": "185 28 28",
                    "light": "241 245 249",
                    "dark": "30 41 59",
                    "dark-primary": "21 94 117",
                },
                "theme-4": {
                    "primary": "49 46 129",
                    "secondary": "226 232 240",
                    "success": "5 150 105",
                    "info": "6 182 212",
                    "warning": "234 179 8",
                    "pending": "234 88 12",
                    "danger": "185 28 28",
                    "light": "241 245 249",
                    "dark": "30 41 59",
                    "dark-primary": "67 56 202",
                }

            },
        },
    },
    plugins: [],
};