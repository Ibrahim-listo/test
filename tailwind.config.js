import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

export default {
  darkMode: 'class',
  // Use a glob pattern to match all relevant files
  content: ['./{vendor/laravel,storage/framework/views,resources/views}/**/*.{blade,php,js,jsx}', './resources/js/**/*.{js,jsx}', './node_modules/flowbite/**/*.js'],

  theme: {
    extend: {
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
    },
  },

  plugins: [
    forms,
    require('flowbite/plugin')
  ],
}
