// main.config.js

const { TailwindCss } = require('tailwindcss-react-native');
const autoprefixer = require('autoprefixer');

module.exports = {
  plugins: [
    new TailwindCss({
      config: './tailwind.config.js',
    }),
    autoprefixer,
  ],
};


npm install tailwindcss-react-native
npm install autoprefixer


module.exports = {
  mode: 'jit',
  purge: ['./src/**/*.{js,jsx,ts,tsx}', './public/index.html'],
  darkMode: false,
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [],
};
