<?php
require 'functions.php'; require_login(); require 'config.php';
$id=filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
if (!$id) { http_response_code(404); exit('Not found'); }
$stmt=$pdo->prepare('SELECT kode,pelanggan,telepon,layanan,berat,status FROM laundry WHERE id=?');
$stmt->execute([$id]); $data=$stmt->fetch();
if (!$data) { http_response_code(404); exit(tr('not_found')); }
$errors=[];
if ($_SERVER['REQUEST_METHOD']==='POST') {
    verify_csrf();
    foreach (array_keys($data) as $key) $data[$key]=trim((string)($_POST[$key] ?? ''));
    $errors=validate_laundry($data);
    if (!$errors) {
        try {
            $stmt=$pdo->prepare('UPDATE laundry SET kode=?,pelanggan=?,telepon=?,layanan=?,berat=?,status=?,harga_per_kg=?,total_harga=? WHERE id=?');
            $harga=rate($data['layanan']);
            $stmt->execute([$data['kode'],$data['pelanggan'],$data['telepon'],$data['layanan'],$data['berat'],$data['status'],$harga,round((float)$data['berat']*$harga),$id]);
            redirect('index.php?msg=updated');
        } catch (PDOException $e) { if ($e->getCode()==='23000') $errors[]=tr('duplicate'); else throw $e; }
    }
}
require 'header.php'; ?><div class="page-heading"><h1><?= h(tr('edit')) ?></h1><p><?= h(tr('rate_note')) ?></p></div><?php require 'laundry_form.php'; require 'footer.php'; ?>
