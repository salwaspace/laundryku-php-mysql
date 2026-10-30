<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
require_once __DIR__ . '/translations.php';
function h($value): string { return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
function tr(string $key): string {
    global $translations;
    $lang = $_SESSION['lang'] ?? 'id';
    return $translations[$lang][$key] ?? $key;
}
function require_login(): void {
    if (empty($_SESSION['user_id'])) { header('Location: login.php'); exit; }
}
function csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    return $_SESSION['csrf_token'];
}
function verify_csrf(): void {
    if (!hash_equals(csrf_token(), (string)($_POST['csrf_token'] ?? ''))) {
        http_response_code(403); exit('Invalid CSRF token');
    }
}
function redirect(string $url): void { header('Location: ' . $url); exit; }
function validate_laundry(array $data): array {
    $errors=[];
    foreach (['kode','pelanggan','telepon','layanan','berat','status'] as $field) {
        if (trim((string)($data[$field] ?? '')) === '') $errors[] = tr('required') . ': ' . tr($field);
    }
    if ($data['kode'] !== '' && !preg_match('/^[A-Za-z0-9-]{3,20}$/D', $data['kode'])) $errors[] = tr('invalid_code');
    if ($data['telepon'] !== '' && !preg_match('/^\+?[0-9]{9,15}$/D', $data['telepon'])) $errors[] = tr('invalid_phone');
    if ($data['berat'] !== '' && (!is_numeric($data['berat']) || (float)$data['berat'] <= 0 || (float)$data['berat'] > 999)) $errors[] = tr('invalid_weight');
    if (!in_array($data['layanan'], ['Cuci Kering','Cuci Setrika','Setrika Saja'], true)) $errors[] = tr('invalid_service');
    if (!in_array($data['status'], ['Proses','Selesai','Diambil'], true)) $errors[] = tr('invalid_status');
    if (strlen($data['pelanggan']) > 100) $errors[] = tr('too_long');
    return $errors;
}
function rate(string $service): int {
    switch ($service) {
        case 'Cuci Kering': return 6000;
        case 'Cuci Setrika': return 8000;
        case 'Setrika Saja': return 5000;
        default: return 0;
    }
}
function money($value): string { return 'Rp' . number_format((float)$value, 0, ',', '.'); }
