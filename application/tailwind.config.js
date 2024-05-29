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
                "primary": "#28EB64",
            },
            "fontFamily": {
                "machina": ["PPMachina", "sans-serif"],
            },
        },
        plugins: [],
    }
}
