const CACHE_NAME = 'nutriteia-v1';
const ASSETS_TO_CACHE = [
  './',
  './Login.html',
  './principal.html',
  './cadastrodeusuario.html',
  './cadastro_alimento.html',
  './style.css'
];

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => cache.addAll(ASSETS_TO_CACHE))
  );
});

self.addEventListener('fetch', (event) => {
  event.respondWith(
    caches.match(event.request).then((response) => response || fetch(event.request))
  );
});