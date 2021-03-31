//キャッシュ名
var CACHE_NAME  = "Hzlink-PWA";

//キャッシュするファイル名
var urlsToCache = [
	'apple-touch-icon.png',	
	'favicon.ico',
	'icon192.png',
	'icon256.png',
	'index.html',
	'manifest.json',
	'service-worker.js',
	'Instagram.png',
	'LINE.png',
	'Twitter.png',
	'game.png',
	'hazass.png',
	'libero.png',
	'liberop.png',
	'occult.png',
	'one.png',
];

//インストール時処理
self.addEventListener('install', function(event) {
    event.waitUntil(
        caches
        .open(CACHE_NAME)
        .then(function(cache){
            return cache.addAll(urlsToCache);
        })
    );
});

// フェッチ時のキャッシュロード処理
self.addEventListener('fetch', function(event) {
    event.respondWith(
        caches
            .match(event.request)
            .then(function(response) {
                if(response){
                    return response;
                }
                return fetch(event.request);
            })
    );
});
