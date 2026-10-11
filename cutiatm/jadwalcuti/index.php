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

<h2>Hari Libur</h2>

<p>Kelola hari libur nasional dan perusahaan.</p>

</div>

<div class="page-action">

<button
class="btn btn-primary"
data-toggle="modal"
data-target="#modalLibur">

<i class="fa-solid fa-plus"></i>

Tambah Hari Libur

</button>

<a
href="print.php"
class="btn btn-secondary">

<i class="fa-solid fa-print"></i>

Cetak

</a>

</div>

</div>

<div class="search-wrapper">

<div class="search-box">

<i class="fa-solid fa-magnifying-glass"></i>

<input
type="text"
placeholder="Cari Hari Libur...">

</div>

</div>

<div class="panel">

<div class="panel-header">

<h3 class="panel-title">

Daftar Hari Libur

</h3>

</div>

<table class="table-modern">

<thead>

<tr>

<th>No</th>

<th>Tanggal</th>

<th>Nama Hari Libur</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

$q=mysqli_query($conn,"
SELECT *
FROM jadwalcuti
ORDER BY tanggal ASC
");

while($d=mysqli_fetch_assoc($q)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= date("d-m-Y",strtotime($d['tanggal'])); ?></td>

<td><?= $d['namalibur']; ?></td>

<td>

<button class="btn btn-secondary">

<i class="fa-solid fa-pen"></i>

</button>

<button class="btn btn-danger">

<i class="fa-solid fa-trash"></i>

</button>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<!-- MODAL TAMBAH -->

<div
class="modal fade"
id="modalLibur"
tabindex="-1">

<div class="modal-dialog modal-lg">

<div class="modal-content">

<form
method="POST"
action="jadwalcuti.input.php">

<div class="modal-header">

<h4 class="modal-title">

<i class="fa-solid fa-calendar-days"></i>

Tambah Hari Libur

</h4>

<button
type="button"
class="close"
data-dismiss="modal">

&times;

</button>

</div>

<div class="modal-body">

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Tanggal</label>

<input
type="date"
name="tanggal"
class="form-control"
required>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Nama Hari Libur</label>

<input
type="text"
name="namalibur"
class="form-control"
placeholder="Contoh : Hari Raya Natal"
required>

</div>

</div>

</div>

</div>

<div class="modal-footer">

<button
type="button"
class="btn btn-secondary"
data-dismiss="modal">

Batal

</button>

<button
type="submit"
name="simpan"
class="btn btn-primary">

<i class="fa-solid fa-floppy-disk"></i>

Simpan

</button>

</div>

</form>

</div>

</div>

</div>

<?php include "../template/footer.php"; ?>