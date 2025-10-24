// Lokasi file: tailwind.config.js
import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php', // Pastikan path ini benar
    ],

    theme: {
        extend: {
            fontFamily: {
                // Gunakan Figtree sebagai font default sans-serif
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            // Kamu bisa menambahkan warna custom di sini jika perlu
            // colors: {
            //     'brand-blue': '#1e40af', // Contoh
            //     'brand-yellow': '#facc15', // Contoh
            // }
        },
    },

    plugins: [forms],
};
