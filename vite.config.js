import { defineConfig } from 'vite';
import laravel from 'vite-plugin-laravel';
import react from '@vitejs/plugin-react';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.jsx'],
      refresh: true,
    }),
    react({
      jsxImportSource: '@emotion/react',
      babel: {
        plugins: ['babel-plugin-macros', 'transform-class-properties'],
      },
    }),
  ],
  server: {
    host: true,
    hmr: {
      host: 'localhost',
      port: 3000,
    },
  },
  build: {
    outDir: 'public/build',
    rollupOptions: {
      output: {
        assetFileNames: 'assets/[name].[ext]',
        chunkFileNames: 'assets/js/[name].js',
        entryFileNames: 'assets/js/[name].js',
      },
    },
  },
});
