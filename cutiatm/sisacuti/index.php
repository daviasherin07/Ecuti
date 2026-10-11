<?php
session_start();

include "../function/koneksi.php";
include "../template/header.php";

$nip=$_SESSION['nip'];

$qPegawai=mysqli_query($conn,"
SELECT *
FROM karyawan
WHERE nip='$nip'
");

$pegawai=mysqli_fetch_assoc($qPegawai);

$qTerpakai=mysqli_query($conn,"
SELECT IFNULL(SUM(lamacuti),0) AS terpakai
FROM pengajuancuti
WHERE nip='$nip'
AND status='Disetujui'
");

$terpakai=mysqli_fetch_assoc($qTerpakai);
?>

<div class="wrapper">

<?php include "../template/sidebar.php"; ?>

<div class="content">

<?php include "../template/topbar.php"; ?>

<div class="main-content">

<div class="page-header">

<div>

<h2>

<i class="fa-solid fa-hourglass-half"></i>

Sisa Cuti

</h2>

<p>

Informasi jatah cuti dan riwayat cuti Anda.

</p>

</div>

<div>

<a
href="print.php"
class="btn btn-secondary">

<i class="fa-solid fa-print"></i>

Cetak

</a>

</div>

</div>


<div class="row">

<div class="col-md-4">

<div class="panel">

<div class="panel-body d-flex align-items-center">

<div class="icon-card warning">

<i class="fa-solid fa-hourglass-half"></i>

</div>

<div>

<h2><?= $pegawai['sisacuti']; ?></h2>

<span>Hari Cuti Tersisa</span>

</div>

</div>

</div>

</div>


<div class="col-md-4">

<div class="panel">

<div class="panel-body d-flex align-items-center">

<div class="icon-card success">

<i class="fa-solid fa-calendar-check"></i>

</div>

<div>

<h2><?= $terpakai['terpakai']; ?></h2>

<span>Hari Cuti Terpakai</span>

</div>

</div>

</div>

</div>


<div class="col-md-4">

<div class="panel">

<div class="panel-body d-flex align-items-center">

<div class="icon-card primary">

<i class="fa-solid fa-user"></i>

</div>

<div>

<h4><?= $pegawai['nama']; ?></h4>

<span><?= $pegawai['level']; ?></span>

</div>

</div>

</div>

</div>

</div>



<div class="panel" style="margin-top:25px;">

<div class="panel-header">

<h3>

Riwayat Cuti Disetujui

</h3>

</div>

<div class="panel-body">

<table class="table-modern">

<thead>

<tr>

<th>No</th>

<th>Jenis Cuti</th>

<th>Tanggal Mulai</th>

<th>Lama</th>

<th>Alasan</th>

<th>Status</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

$query=mysqli_query($conn,"
SELECT
j.jeniscuti,
p.tanggalmulai,
p.lamacuti,
p.alasancuti,
p.status
FROM pengajuancuti p
JOIN jeniscuti j
ON p.idcuti=j.idcuti
WHERE p.nip='$nip'
AND p.status='Disetujui'
ORDER BY p.tanggalmulai DESC
");

while($d=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $d['jeniscuti']; ?></td>

<td><?= date("d-m-Y",strtotime($d['tanggalmulai'])); ?></td>

<td><?= $d['lamacuti']; ?> Hari</td>

<td><?= $d['alasancuti']; ?></td>

<td>

<span class="status status-success">

Disetujui

</span>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</div>
<style>
.icon-card{
width:60px;
height:60px;
border-radius:15px;
display:flex;
justify-content:center;
align-items:center;
font-size:24px;
margin-right:18px;
}

.warning{
background:#fff4df;
color:#d98a00;
}

.success{
background:#eaf8ef;
color:#1ca04c;
}

.primary{
background:#eef4ff;
color:#3b6ee8;
}

.d-flex{
display:flex;
}

.align-items-center{
align-items:center;
}

.panel-body h2{
margin:0;
font-size:42px;
font-weight:bold;
}

.panel-body h4{
margin:0;
font-weight:bold;
}

.panel-body span{
color:#777;
}
</style>
<?php include "../template/footer.php"; ?>