<?php

include "../function/koneksi.php";

$keyword = isset($_GET['keyword']) ? mysqli_real_escape_string($conn,$_GET['keyword']) : "";

$query = mysqli_query($conn,"
SELECT
p.*,
k.nama,
j.jeniscuti
FROM pengajuancuti p
LEFT JOIN karyawan k
ON p.nip=k.nip
LEFT JOIN jeniscuti j
ON p.idcuti=j.idcuti
WHERE

p.nip LIKE '%$keyword%'

OR

k.nama LIKE '%$keyword%'

OR

j.jeniscuti LIKE '%$keyword%'

ORDER BY p.idpengajuancuti DESC
");

$no=1;

?>

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

<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php while($d=mysqli_fetch_assoc($query)){ ?>

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

<td>

<button
class="btn btn-secondary"
disabled>

<i class="fa-solid fa-eye"></i>

</button>

<button
class="btn btn-danger hapus"
id="<?= $d['idpengajuancuti']; ?>">

<i class="fa-solid fa-trash"></i>

</button>

</td>

</tr>

<?php } ?>

</tbody>

</table>