import { defineConfig } from 'vite';
import laravelPlugin from 'laravel-vite-plugin';
import reactPlugin from '@vitejs/plugin-react';

export default defineConfig({
  plugins: [
    laravelPlugin({
      inputFile: 'resources/js/app.jsx',
      hotModuleReplacement: true,
    }),
    reactPlugin(),
  ],
});
