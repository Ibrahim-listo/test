// Import the default theme from Tailwind CSS
import defaultTheme from 'tailwindcss/defaultTheme';

// Import the forms module from Tailwind CSS
import forms from '@tailwindcss/forms';

// The main exported object containing the configuration
export default {
  // Enable dark mode based on a class, not a media query
  darkMode: 'class',

  // An array of glob patterns matching the relevant files
  content: [
    './{vendor/laravel,storage/framework/views,resources/views}/**/*.{blade,php,js,jsx}',
    './resources/js/**/*.{js,jsx}',
    './node_modules/flowbite/**/*.js'
  ],

  // Theme configuration
  theme: {
    extend: {
      // Extend the font family with a custom font
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
    },
  },

  // Plugins configuration
  plugins: [
    // Import and configure the forms module
    forms,
    // Import and configure the Flowbite plugin
    require('flowbite/plugin')
  ],
};

