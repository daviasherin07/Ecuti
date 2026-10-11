<?php

session_start();

include "../function/koneksi.php";

if(isset($_POST['simpan'])){

    $idcuti    = mysqli_real_escape_string($conn,$_POST['idcuti']);
    $jeniscuti = mysqli_real_escape_string($conn,$_POST['jeniscuti']);

    $cek=mysqli_query($conn,"
        SELECT *
        FROM jeniscuti
        WHERE idcuti='$idcuti'
    ");

    if(mysqli_num_rows($cek)>0){

        echo "<script>

        alert('ID Cuti sudah digunakan');

        window.location='index.php';

        </script>";

        exit;

    }

    $simpan=mysqli_query($conn,"
        INSERT INTO jeniscuti
        (
            idcuti,
            jeniscuti
        )
        VALUES
        (
            '$idcuti',
            '$jeniscuti'
        )
    ");

    if($simpan){

        echo "<script>

        alert('Data berhasil disimpan');

        window.location='index.php';

        </script>";

    }

}
/* ==========================
HAPUS
========================== */

if(isset($_GET['hapus'])){

$id=$_GET['hapus'];

mysqli_query($conn,"
DELETE FROM jeniscuti
WHERE idcuti='$id'
");

header("Location:index.php");
exit;

}
if(isset($_POST['update'])){

$idlama=$_POST['idlama'];

$jenis=$_POST['jeniscuti'];

mysqli_query($conn,"
UPDATE jeniscuti
SET
jeniscuti='$jenis'
WHERE idcuti='$idlama'
");

header("Location:index.php");
exit;

}