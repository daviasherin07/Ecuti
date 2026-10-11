<?php

include "../function/koneksi.php";

$no=1;

$keyword = "";

if(isset($_GET['keyword'])){
    $keyword = mysqli_real_escape_string($conn,$_GET['keyword']);
}

$data = mysqli_query($conn,"
SELECT *
FROM karyawan
WHERE
nip LIKE '%$keyword%'
OR nama LIKE '%$keyword%'
OR divisi LIKE '%$keyword%'
OR level LIKE '%$keyword%'
ORDER BY nip ASC
");
?>

<table class="table-modern">

<thead>

<tr>

<th width="60">No</th>

<th>NIP</th>

<th>Nama</th>

<th>Divisi</th>

<th>Level</th>

<th>Sisa Cuti</th>

<th width="150">Aksi</th>

</tr>

</thead>

<tbody>

<?php while($d=mysqli_fetch_assoc($data)){ ?>

<tr>

<td><?= $no++; ?></td>

<td><?= $d['nip']; ?></td>

<td><?= $d['nama']; ?></td>

<td><?= $d['divisi']; ?></td>

<td><?= $d['level']; ?></td>

<td><?= $d['sisacuti']; ?> Hari</td>

<td>

<a href="index.php?edit=<?= $d['nip']; ?>" class="btn btn-secondary"><i class="fa-solid fa-pen"></i></a>

<button
class="btn btn-danger hapus"
data-id="<?= $d['nip']; ?>">

<i class="fa-solid fa-trash"></i>

</button>

</td>

</tr>

<?php } ?>

</tbody>

</table>