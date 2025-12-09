<?php
/**
 * Drakon Webhook Handler - Root Level
 * This file handles when Drakon appends /drakon_api to the base URL
 * URL configured in Drakon: https://a49000.win/webhook
 * Drakon will call: https://a49000.win/webhook/drakon_api
 */

// Get the request URI
$requestUri = $_SERVER['REQUEST_URI'] ?? '';

// Check if this is a drakon_api request
if (strpos($requestUri, '/drakon_api') !== false || strpos($requestUri, 'drakon') !== false) {
    // Bootstrap Laravel
    require __DIR__.'/../vendor/autoload.php';
    $app = require_once __DIR__.'/../bootstrap/app.php';
    
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    
    // Create request with /drakon_api path
    $_SERVER['REQUEST_URI'] = '/drakon_api';
    $_SERVER['PATH_INFO'] = '/drakon_api';
    
    $response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
    );
    
    $response->send();
    $kernel->terminate($request, $response);
    exit;
}

// If not drakon, return 404
http_response_code(404);
echo json_encode(['error' => 'Not found']);
exit;
