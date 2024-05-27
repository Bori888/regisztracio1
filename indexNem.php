<?php
header('Content-Type: application/json');
// Példa: URL elemzése és megfelelő funkció hívása
$requestMethod = $_SERVER['REQUEST_METHOD'];
/* $requestUri = strtok($_SERVER['REQUEST_URI'], '?'); //kérdőjel nélkül */
$basePath = '/regisztracio'; // Az alkalmazás gyökérútvonala

// Eltávolítjuk a gyökérútvonalat a kérésekből
$path = str_replace($basePath, '', $requestUri);

// Például meghatározhatjuk az útvonalakat egy asszociatív tömb segítségével
$routes = [
    'GET' => [
        '/' => __DIR__ . '/login.php',
        '/about' => __DIR__ . '/views/about.php',
        '/active' => __DIR__ . '/active-users.php',
        '/contact' => __DIR__ . '/views/contact.php',
        '/category' => __DIR__ . '/category.php',
        '/404' => __DIR__ . '/views/404.php',
    ],
    'POST' => [
        '/category' => __DIR__ . '/category-post.php',
        // további POST útvonalak
    ],
    'PUT' => [
        '/category' => __DIR__ . '/category-put.php',
        // további PUT útvonalak
    ],
    'DELETE' => [
        '/category' => __DIR__ . '/category-delete.php',
        // további DELETE útvonalak
    ],
];


// Ha az útvonal szerepel a definiált útvonalak között, importáljuk a megfelelő fájlt
if (isset($routes[$requestMethod][$path])) {
    include($routes[$requestMethod][$path]);
} 
else {
    http_response_code(404);
    include($routes[$requestMethod]['/404']);
}

