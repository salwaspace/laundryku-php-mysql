<?php
require 'functions.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit('Method not allowed'); }
verify_csrf();
$lang = (string)($_POST['lang'] ?? 'id');
if (in_array($lang, ['id', 'en'], true)) $_SESSION['lang'] = $lang;
$target = (string)($_POST['return_to'] ?? 'index.php');
if (!in_array($target, ['login.php','index.php','create.php','edit.php'], true)) $target='index.php';
if ($target === 'edit.php') $target = 'index.php';
redirect($target);
