<?php
require 'functions.php'; require_login();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit('Method not allowed'); }
verify_csrf();
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id) { http_response_code(400); exit('Invalid ID'); }
require 'config.php';
$stmt = $pdo->prepare('DELETE FROM laundry WHERE id=?');
$stmt->execute([$id]);
redirect('index.php?msg=removed');
