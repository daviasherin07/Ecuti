<?php
session_start();

include "../template/header.php";
include "../function/koneksi.php";
?>

<div class="wrapper">

<?php include "../template/sidebar.php"; ?>

<div class="content">

<?php include "../template/topbar.php"; ?>

<div class="main-content">

<div class="page-header">

<div>

<h2>

<i class="fa-solid fa-paper-plane"></i>

Pengajuan Cuti

</h2>

<p>

Ajukan permohonan cuti dan pantau statusnya melalui menu Cek Pengajuan.

</p>

</div>

</div>

<div class="panel">

<div class="panel-header">

<h3 class="panel-title">

Form Pengajuan Cuti

</h3>

<div>

Isi data dengan lengkap

</div>

</div>

<div class="panel-body">

<form method="POST" action="pengajuancuti.input.php">

<div class="row">
    <div class="col-md-6">

<div class="form-group">

<label>NIP Karyawan</label>

<input
type="text"
name="nip"
class="form-control"
value="<?= $_SESSION['nip']; ?>"
readonly>

</div>

</div>
<div class="col-md-6">

<div class="form-group">

<label>Nama</label>

<input
type="text"
name="nama"
class="form-control"
value="<?= $_SESSION['nama']; ?>"
readonly>

</div>

</div>
<div class="col-md-6">

<div class="form-group">

<label>Jenis Cuti</label>

<select
name="idcuti"
class="form-control"
required>

<option value="">Pilih Jenis Cuti</option>

<?php

$query=mysqli_query($conn,"
SELECT *
FROM jeniscuti
ORDER BY jeniscuti
");

while($d=mysqli_fetch_assoc($query)){

?>

<option value="<?= $d['idcuti']; ?>">

<?= $d['jeniscuti']; ?>

</option>

<?php } ?>

</select>

</div>

</div>
<div class="col-md-6">

<div class="form-group">

<label>Tanggal Pengajuan</label>

<input
type="date"
name="tanggalmulai"
class="form-control"
required>

</div>

</div>
<div class="col-md-6">

<div class="form-group">

<label>Tanggal Mulai Cuti</label>

<input
type="date"
name="tanggalmulai"
class="form-control"
required>

</div>

</div>
<div class="col-md-6">

<div class="form-group">

<label>Lama Hari Cuti</label>

<input
type="number"
name="lamacuti"
class="form-control"
required>

<small>

Sistem akan mengurangi sisa cuti setelah disetujui admin.

</small>

</div>

</div>
<div class="col-md-12">

<div class="form-group">

<label>Alasan Cuti</label>

<textarea
name="alasancuti"
rows="4"
class="form-control"
placeholder="Tuliskan alasan cuti..."
required></textarea>

</div>

</div>
<div class="col-md-12">

<button
type="submit"
name="simpan"
class="btn btn-primary">

Ajukan Permohonan

</button>

<button
type="reset"
class="btn btn-secondary">

Reset

</button>

</div>

</div>

</form>

</div>

</div>

</div>

</div>

<?php include "../template/footer.php"; ?>