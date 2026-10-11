<?php

include "../function/koneksi.php";

$no = 1;

if($_SESSION['level']=="Administrator"){

$query = mysqli_query($conn,"
SELECT
p.idpengajuancuti,
p.nip,
k.nama,
j.jeniscuti,
p.tanggalmulai,
p.lamacuti,
p.alasancuti,
p.status
FROM pengajuancuti p
LEFT JOIN karyawan k
ON p.nip=k.nip
LEFT JOIN jeniscuti j
ON p.idcuti=j.idcuti
ORDER BY p.idpengajuancuti DESC
");

}else{

$nip=$_SESSION['nip'];

$query = mysqli_query($conn,"
SELECT
p.idpengajuancuti,
p.nip,
k.nama,
j.jeniscuti,
p.tanggalmulai,
p.lamacuti,
p.alasancuti,
p.status
FROM pengajuancuti p
LEFT JOIN karyawan k
ON p.nip=k.nip
LEFT JOIN jeniscuti j
ON p.idcuti=j.idcuti
WHERE p.nip='$nip'
ORDER BY p.idpengajuancuti DESC
");

}

?>

<table class="table-modern">

<thead>

<tr>

<th>No</th>

<th>NIP</th>

<th>Nama Pegawai</th>

<th>Jenis Cuti</th>

<th>Tanggal Mulai</th>

<th>Lama</th>

<th>Status</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php

while($data=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $data['nip']; ?></td>

<td><?= $data['nama']; ?></td>

<td><?= $data['jeniscuti']; ?></td>

<td><?= date('d-m-Y',strtotime($data['tanggalmulai'])); ?></td>

<td><?= $data['lamacuti']; ?> Hari</td>

<td>

<?php

if($data['status']=="Pending"){

?>

<span class="status status-warning">

Pending

</span>

<?php

}elseif($data['status']=="Disetujui"){

?>

<span class="status status-success">

Disetujui

</span>

<?php

}else{

?>

<span class="status status-danger">

Ditolak

</span>

<?php

}

?>

</td>

<td>

<button
class="btn btn-secondary"
title="Detail">

<i class="fa-solid fa-eye"></i>

</button>

<button
class="btn btn-danger"
title="Hapus">

<i class="fa-solid fa-trash"></i>

</button>

</td>

</tr>

<?php

}

?>

</tbody>

</table>