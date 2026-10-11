<?php
session_start();

include "../template/header.php";
?>

<div class="wrapper">

<?php include "../template/sidebar.php"; ?>

<div class="content">

<?php include "../template/topbar.php"; ?>

<div class="main-content">

    <div class="page-header">

        <div>

            <h2>Cek Pengajuan Cuti</h2>

            <p>

                Lihat status seluruh pengajuan cuti pegawai.

            </p>

        </div>

    </div>

    <div class="search-wrapper">

        <div class="search-box">

            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                type="text"
                placeholder="Cari NIP atau Nama Pegawai...">

        </div>

    </div>

    <div class="panel">

        <div class="panel-header">

            <h3 class="panel-title">

                Status Pengajuan Cuti

            </h3>

        </div>

        <table class="table-modern">

            <thead>

                <tr>

                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Jenis Cuti</th>
                    <th>Tanggal</th>
                    <th>Lama</th>
                    <th>Status</th>

                </tr>

            </thead>

<tbody>

<?php

include "../function/koneksi.php";

$query = mysqli_query($conn,"
SELECT
p.*,
k.nama,
j.jeniscuti
FROM pengajuancuti p
LEFT JOIN karyawan k
ON p.nip = k.nip
LEFT JOIN jeniscuti j
ON p.idcuti = j.idcuti
ORDER BY p.idpengajuancuti DESC
");

$no = 1;

while($d = mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $d['nip']; ?></td>

<td><?= $d['nama']; ?></td>

<td><?= $d['jeniscuti']; ?></td>

<td><?= date("d-m-Y",strtotime($d['tanggalmulai'])); ?></td>

<td><?= $d['lamacuti']; ?> Hari</td>

<td>

<?php

if($d['status']=="Pending"){

echo '<span class="status status-warning">Pending</span>';

}elseif($d['status']=="Disetujui"){

echo '<span class="status status-success">Disetujui</span>';

}else{

echo '<span class="status status-danger">Ditolak</span>';

}

?>

</td>

</tr>

<?php } ?>

</tbody>

        </table>

    </div>

</div>

</div>

<?php include "../template/footer.php"; ?>