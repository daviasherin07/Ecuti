<?php

include "../function/koneksi.php";

if(isset($_POST['simpan'])){

    $tanggal   = mysqli_real_escape_string($conn,$_POST['tanggal']);
    $namalibur = mysqli_real_escape_string($conn,$_POST['namalibur']);

    mysqli_query($conn,"
        INSERT INTO jadwalcuti
        (
            tanggal,
            namalibur
        )
        VALUES
        (
            '$tanggal',
            '$namalibur'
        )
    ");

}

header("Location:index.php");
exit;