// Import the necessary modules and functions for configuring Vite.
import { defineConfig } from 'vite';
import laravel from 'vite-plugin-laravel';
import react from '@vitejs/plugin-react';

// The main configuration object for Vite.
export default defineConfig({
  // An array of plugins to be used in the configuration.
  plugins: [
    // The Laravel plugin for Vite, which handles Laravel-specific configurations.
    laravel({
      // The entry points for CSS and JS files.
      input: ['resources/css/app.css', 'resources/js/app.jsx'],
      // Automatically refreshes the browser on file changes.
      refresh: true,
    }),

    // The React plugin for Vite, which handles React-specific configurations.
    react({
      // The source for importing JSX components.
      jsxImportSource: '@emotion/react',
      // An array of Babel plugins to be used in the configuration.
      babel: {
        plugins: ['babel-plugin-macros', 'transform-class-properties'],
      },
    }),
  ],

  // Configuration for the development server.
  server: {
    // Enables the server to listen on all available network interfaces.
    host: true,
    // Configuration for the hot module replacement (HMR) feature.
    hmr: {
      // The hostname for the HMR server.
      host: 'localhost',
      // The port for the HMR server.
      port: 3000,
    },
  },

  // Configuration for the build process.
  build: {
    // The output directory for the built files.
    outDir: 'public/build',
    // Configuration for Rollup, a bundler used by Vite.
    rollupOptions: {
      // Configuration for the output of the bundled files.
      output: {
        // The filename pattern for assets.
        assetFileNames: 'assets/[name].[ext]',
        // The filename pattern for chunks.
        chunkFileNames: 'assets/js/[name].js',
