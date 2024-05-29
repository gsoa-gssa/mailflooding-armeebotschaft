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
                "primary": "#52001D",
            },
            "fontFamily": {
                "garamond": ["EB Garamond", "serif"],
                "bebas": ["Bebas Neue", "display"],
            },
        },
        plugins: [],
    }
}
