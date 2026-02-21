<?php

// Mengarahkan Vercel agar menganggap folder root sebagai pangkalan
$root = __DIR__ . '/../';

// Memanggil autoload langsung dari root
require $root . 'vendor/autoload.php';

// Menjalankan aplikasi Laravel
$app = require_once $root . 'bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
)->send();

$kernel->terminate($request, $response);