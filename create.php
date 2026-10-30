<?php
require 'functions.php'; require_login(); require 'config.php';
$data = ['kode'=>'','pelanggan'=>'','telepon'=>'','layanan'=>'Cuci Kering','berat'=>'','status'=>'Proses']; $errors=[];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    foreach (array_keys($data) as $key) $data[$key] = trim((string)($_POST[$key] ?? ''));
    $errors = validate_laundry($data);
    if (!$errors) {
        try {
            $stmt=$pdo->prepare('INSERT INTO laundry (kode,pelanggan,telepon,layanan,berat,status,harga_per_kg,total_harga) VALUES (?,?,?,?,?,?,?,?)');
            $harga=rate($data['layanan']);
            $stmt->execute([$data['kode'],$data['pelanggan'],$data['telepon'],$data['layanan'],$data['berat'],$data['status'],$harga,round((float)$data['berat']*$harga)]);
            redirect('index.php?msg=saved');
        } catch (PDOException $e) { if ($e->getCode()==='23000') $errors[]=tr('duplicate'); else throw $e; }
    }
}
require 'header.php'; ?><div class="page-heading"><h1><?= h(tr('add')) ?></h1><p><?= h(tr('rate_note')) ?></p></div><?php require 'laundry_form.php'; require 'footer.php'; ?>
