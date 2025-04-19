// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';

// export default defineConfig({
//     server: {
//         host: '192.168.0.3', // O  host: true
//         // Otros ajustes de servidor
//     },
//     plugins: [
//         laravel({
//             input: ['resources/css/app.css', 'resources/js/app.js'],
//             refresh: true,
//         }),
//     ],
// });



import { defineConfig } from 'vite';
import { createServer } from 'http'; // Import the createServer function
import laravel from 'laravel-vite-plugin';


export default defineConfig({
  server: {
    port: 5173,
    host: '0.0.0.0', // Cambia esto para permitir conexiones desde otros dispositivos
    proxy: {
      '/api': {
        target: 'http://192.168.0.5:8000', // Usa la IP de tu PC en la red local
        changeOrigin: true,
        rewrite: (path) => path.replace(/^\/api/, ''),
      },
    },
  },
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
    {
      name: 'configure-server',
      configureServer(server) {
        const nodeServer = createServer((req, res) => {
          const { url } = req;

          if (url.startsWith('/data')) {
            res.statusCode = 200;
            res.setHeader('Content-Type', 'application/json');
            const data = { message: '¡Hola desde el servidor Node.js!', url };
            res.end(JSON.stringify(data));
          } else if (url === '/') {
            res.statusCode = 200;
            res.setHeader('Content-Type', 'text/plain');
            res.end('¡Hola, mundo desde el servidor Node.js!\n');
          } else {
            res.statusCode = 404;
            res.setHeader('Content-Type', 'text/plain');
            res.end('No encontrado\n');
          }
        });

        const hostname = '0.0.0.0'; // Escucha en todas las interfaces
        const port = 3000;
        nodeServer.listen(port, hostname, () => {
          console.log(`Servidor Node.js corriendo en http://${hostname}:${port}/`);
        });

        server.httpServer?.on('close', () => {
          nodeServer.close();
        });
      },
    },
  ],
});
