<?php

// 1. Arahkan folder penyimpanan ke /tmp agar tidak Error 500
// (Vercel hanya mengizinkan penulisan di folder /tmp)
putenv('VIEW_COMPILED_PATH=/tmp');
putenv('SESSION_DRIVER=cookie');
putenv('LOG_CHANNEL=stderr');

// 2. Jalankan Autoload
require __DIR__ . '/../vendor/autoload.php';

// 3. Inisialisasi Aplikasi Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 4. Jalankan Kernel
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
)->send();

$kernel->terminate($request, $response);