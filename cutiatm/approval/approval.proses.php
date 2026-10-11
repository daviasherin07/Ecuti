<?php

include "../function/koneksi.php";

$id = $_GET['id'];
$aksi = $_GET['aksi'];

$q = mysqli_query($conn,"
SELECT *
FROM pengajuancuti
WHERE idpengajuancuti='$id'
");

$data = mysqli_fetch_assoc($q);

if(!$data){

    header("Location:index.php");
    exit;

}

if($aksi=="setuju"){

    mysqli_query($conn,"
    UPDATE pengajuancuti
    SET status='Disetujui'
    WHERE idpengajuancuti='$id'
    ");

$qSisa = mysqli_query($conn,"
SELECT sisacuti
FROM karyawan
WHERE nip='$data[nip]'
");

$sisa = mysqli_fetch_assoc($qSisa);

if($sisa['sisacuti'] >= $data['lamacuti']){

    mysqli_query($conn,"
    UPDATE karyawan
    SET sisacuti=sisacuti-$data[lamacuti]
    WHERE nip='$data[nip]'
    ");

}

}

if($aksi=="tolak"){

    mysqli_query($conn,"
    UPDATE pengajuancuti
    SET status='Ditolak'
    WHERE idpengajuancuti='$id'
    ");

}

header("Location:index.php");

exit;

?>