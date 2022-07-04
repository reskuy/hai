self.addEventListener('fetch', function(event) {
    event.respondWith(async function() {
    try{
    var res = await fetch(event.request);
    var cache = await caches.open('cache');
    cache.put(event.request.url, res.clone());
    return res;
    }
    catch(error){
    return caches.match(event.request);
    }
    }());
})
self.addEventListener('push', function(event) {
    console.log('[Service Worker] Push Received.');
    console.log(`[Service Worker] Push had this data: "${event.data.text()}"`);
  
    const title = 'Push Codelab';
    const options = {
      body: 'Yay it works.',
      icon: 'images/icon.png',
      badge: 'images/badge.png'
    };
  
    event.waitUntil(self.registration.showNotification(title, options));
  });