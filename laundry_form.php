<section class="panel form-panel"><form method="post"><input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
<?php if ($errors): ?><div class="alert error"><ul><?php foreach ($errors as $e): ?><li><?= h($e) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
<div class="form-grid">
<label><?= h(tr('kode')) ?><input name="kode" maxlength="20" value="<?= h($data['kode']) ?>" placeholder="LDY-001" required></label>
<label><?= h(tr('pelanggan')) ?><input name="pelanggan" maxlength="100" value="<?= h($data['pelanggan']) ?>" required></label>
<label><?= h(tr('telepon')) ?><input name="telepon" maxlength="16" value="<?= h($data['telepon']) ?>" placeholder="081234567890" required></label>
<label><?= h(tr('layanan')) ?><select name="layanan" required><?php foreach (['Cuci Kering'=>'service_dry','Cuci Setrika'=>'service_washiron','Setrika Saja'=>'service_iron'] as $val=>$label): ?><option value="<?= h($val) ?>" <?= $data['layanan']===$val?'selected':'' ?>><?= h(tr($label)) ?> — <?= h(money(rate($val))) ?>/kg</option><?php endforeach; ?></select></label>
<label><?= h(tr('berat')) ?><input name="berat" type="number" min="0.1" max="999" step="0.1" value="<?= h($data['berat']) ?>" required></label>
<label><?= h(tr('status')) ?><select name="status" required><?php foreach (['Proses'=>'status_process','Selesai'=>'status_done','Diambil'=>'status_taken'] as $val=>$label): ?><option value="<?= h($val) ?>" <?= $data['status']===$val?'selected':'' ?>><?= h(tr($label)) ?></option><?php endforeach; ?></select></label>
</div><p class="hint"><?= h(tr('rate_note')) ?></p>
<div class="form-buttons"><button class="primary" type="submit"><?= h(tr('save')) ?></button><a class="secondary" href="index.php"><?= h(tr('cancel')) ?></a></div>
</form></section>
