<?php

// 1. Paksa Laravel menggunakan folder /tmp untuk menulis cache dan views
$tmpDir = '/tmp';
putenv("VIEW_COMPILED_PATH=$tmpDir");
putenv("APP_CONFIG_CACHE=$tmpDir/config.php");
putenv("APP_ROUTES_CACHE=$tmpDir/routes.php");
putenv("APP_SERVICES_CACHE=$tmpDir/services.php");
putenv("APP_PACKAGES_CACHE=$tmpDir/packages.php");

// 2. Jalankan Autoload
require __DIR__ . '/../vendor/autoload.php';

// 3. Inisialisasi Aplikasi
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 4. Jalankan Kernel
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
)->send();

$kernel->terminate($request, $response);