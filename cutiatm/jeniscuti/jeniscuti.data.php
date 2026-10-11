<?php

include "../function/koneksi.php";

$no = 1;

$data = mysqli_query($conn,"
SELECT *
FROM jeniscuti
ORDER BY idcuti ASC
");

?>

<table class="table-modern">

<thead>

<tr>

<th width="60">No</th>

<th>ID Cuti</th>

<th>Jenis Cuti</th>

<th width="150">Aksi</th>

</tr>

</thead>

<tbody>

<?php while($d = mysqli_fetch_assoc($data)){ ?>

<tr>

<td><?= $no++; ?></td>

<td><?= $d['idcuti']; ?></td>

<td><?= $d['jeniscuti']; ?></td>

<td>

<a
href="index.php?edit=<?= $d['idcuti']; ?>"
class="btn btn-secondary">

<i class="fa-solid fa-pen"></i>

</a>

<a
href="jeniscuti.input.php?hapus=<?= $d['idcuti']; ?>"
class="btn btn-danger"
onclick="return confirm('Hapus data ini?')">

<i class="fa-solid fa-trash"></i>

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>