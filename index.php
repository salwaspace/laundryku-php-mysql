<?php
require 'functions.php'; require_login(); require 'config.php';
$orders=$pdo->query('SELECT id,kode,pelanggan,telepon,layanan,berat,status,harga_per_kg,total_harga FROM laundry ORDER BY id DESC')->fetchAll();
$notice=$_GET['msg'] ?? '';
$serviceLabels=['Cuci Kering'=>'service_dry','Cuci Setrika'=>'service_washiron','Setrika Saja'=>'service_iron'];
$statusLabels=['Proses'=>'status_process','Selesai'=>'status_done','Diambil'=>'status_taken'];
require 'header.php'; ?>
<section class="hero"><div><div class="eyebrow">LAUNDRY MANAGEMENT</div><h1><?= h(tr('dashboard')) ?></h1><p><?= h(tr('welcome')) ?>, <?= h($_SESSION['username']) ?>! <?= h(tr('manage')) ?>.</p></div><a class="primary" href="create.php">+ <?= h(tr('add')) ?></a></section>
<?php if (in_array($notice,['saved','updated','removed'],true)): ?><div class="alert success"><?= h(tr($notice)) ?></div><?php endif; ?>
<div class="stat"><div class="stat-icon">🧺</div><div><small><?= h(tr('total')) ?></small><strong><?= count($orders) ?></strong></div></div>
<section class="panel"><div class="panel-title"><h2><?= h(tr('list')) ?></h2><span><?= count($orders) ?> <?= h(tr('records')) ?></span></div><div class="table-wrap"><table><thead><tr><th>#</th><th><?= h(tr('kode')) ?></th><th><?= h(tr('pelanggan')) ?></th><th><?= h(tr('telepon')) ?></th><th><?= h(tr('layanan')) ?></th><th><?= h(tr('berat')) ?></th><th><?= h(tr('total_harga')) ?></th><th><?= h(tr('status')) ?></th><th><?= h(tr('actions')) ?></th></tr></thead><tbody>
<?php foreach ($orders as $i=>$o): ?><tr><td><?= $i+1 ?></td><td><b><?= h($o['kode']) ?></b></td><td><?= h($o['pelanggan']) ?></td><td><?= h($o['telepon']) ?></td><td><?= h(tr($serviceLabels[$o['layanan']] ?? '')) ?></td><td><?= h($o['berat']) ?></td><td><b><?= h(money($o['total_harga'])) ?></b></td><td><span class="status-tag"><?= h(tr($statusLabels[$o['status']] ?? '')) ?></span></td><td class="actions"><a class="edit" href="edit.php?id=<?= (int)$o['id'] ?>"><?= h(tr('edit')) ?></a><form method="post" action="delete.php" onsubmit="return confirm(<?= h(json_encode(tr('confirm'))) ?>)"><input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>"><input type="hidden" name="id" value="<?= (int)$o['id'] ?>"><button class="danger" type="submit"><?= h(tr('delete')) ?></button></form></td></tr><?php endforeach; ?>
<?php if (!$orders): ?><tr><td class="empty" colspan="9"><?= h(tr('empty')) ?></td></tr><?php endif; ?></tbody></table></div></section>
<?php require 'footer.php'; ?>
