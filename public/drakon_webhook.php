<?php
// Webhook Drakon - Arquivo PHP standalone para testes
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Log da requisição
$logData = [
    'timestamp' => date('Y-m-d H:i:s'),
    'method' => $_SERVER['REQUEST_METHOD'],
    'content_type' => $_SERVER['CONTENT_TYPE'] ?? 'none',
    'raw_input' => file_get_contents('php://input'),
    'post' => $_POST,
    'get' => $_GET,
];

// Salvar log
$logFile = __DIR__ . '/../storage/logs/drakon-direct.log';
file_put_contents($logFile, json_encode($logData, JSON_PRETTY_PRINT) . "\n\n", FILE_APPEND);

// Processar requisição
$input = json_decode(file_get_contents('php://input'), true);
$method = $input['method'] ?? $_POST['method'] ?? $_GET['method'] ?? null;

if (!$method) {
    echo json_encode([
        'status' => true,
        'message' => 'Drakon webhook standalone is active',
        'timestamp' => date('c')
    ]);
    exit;
}

// Simular resposta básica
switch ($method) {
    case 'user_balance':
        echo json_encode([
            'status' => true,
            'balance' => 1000.00
        ]);
        break;
    
    case 'account_details':
        echo json_encode([
            'status' => true,
            'data' => [
                'email' => 'test@test.com',
                'name_jogador' => 'Test User',
                'date' => date('c')
            ]
        ]);
        break;
        
    default:
        echo json_encode([
            'status' => true,
            'message' => 'Method received: ' . $method
        ]);
}
