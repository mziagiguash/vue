import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    extend: {
        // Добавляем стили для виджета
        widget: {
          base: 'p-4 bg-white rounded-lg shadow-md',
          heading: 'text-lg font-semibold',
          paragraph: 'text-gray-600',
          button: 'mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
        },
      },
      plugins: [
        forms, // Плагин для работы с формами
      ],
};
