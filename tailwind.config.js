/** @type {import('tailwindcss').Config} */

const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        // "../eduka-ui/resources/**/*.blade.php",
        // "../eduka-ui/resources/**/*.js",
        // "../eduka-ui/resources/**/*.vue",
        ],
    theme: {
        extend: {
            zIndex: {
                1: '1'
            },
            fontFamily: {
                'sans': ['"Titillium Web"', 'sans-serif', ...defaultTheme.fontFamily.sans],
            },
            colors : {
                "primary-black": "#101010",
                "deep-soft-blue": "#272E44",
                // Gray based color.
                'gray-dark-900': '#1C242E',
            },
        },
    },
    plugins: [
        // require('flowbite/plugin'),
        require('@tailwindcss/forms'),
        require('@tailwindcss/aspect-ratio'),
    ]
};
