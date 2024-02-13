import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */

const defaultColors = require('tailwindcss/colors')

const colors = {
    ...defaultColors,
    ...{
        'r_green': {
            100: '#77bb3f',
            200: '#006a35',
        },
        'r_orange' : '#ff8f38',
        'r_white' : '#f2f2f2'
    },
}

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        colors: colors,
        extend: {
            fontFamily: {
                sans: ['Rubik', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, typography],
};
