import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                bgMain: "#070b18",
                bgPanel: "#0b1225",
                orange: "#ff8a00",
                yellow: "#ffc700",
                green: "#2ecc71",
                textMuted: "#9aa4bf"
            },
            boxShadow: {
                glow: "0 0 30px rgba(255,138,0,0.35)"
            }
        },
    },
    plugins: [],
};
