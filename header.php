<!doctype html>
<html lang="<?= h($_SESSION['lang'] ?? 'id') ?>"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= h(tr('app')) ?></title><link rel="stylesheet" href="assets/style.css"></head><body>
<header class="top"><div class="brand"><span class="brand-icon">🧺</span><div><strong><?= h(tr('app')) ?></strong><small><?= h(tr('subtitle')) ?></small></div></div>
<div class="header-actions"><form action="language.php" method="post" class="language"><input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>"><input type="hidden" name="return_to" value="<?= h(basename((string)parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) ?>"><label for="lang"><?= h(tr('language')) ?></label><select id="lang" name="lang" onchange="this.form.submit()"><option value="id" <?= ($_SESSION['lang'] ?? 'id')==='id'?'selected':'' ?>>Indonesia</option><option value="en" <?= ($_SESSION['lang'] ?? 'id')==='en'?'selected':'' ?>>English</option></select></form>
<?php if (!empty($_SESSION['user_id'])): ?><a class="logout" href="logout.php"><?= h(tr('logout')) ?></a><?php endif; ?></div></header>
<main class="container">
<?php if (!empty($_SESSION['user_id'])): ?><nav><a href="index.php"><?= h(tr('dashboard')) ?></a><a href="create.php"><?= h(tr('add')) ?></a></nav><?php endif; ?>
