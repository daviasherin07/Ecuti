<?php

session_start();

include "../function/koneksi.php";

if(isset($_POST['simpan'])){

    $nip              = mysqli_real_escape_string($conn,$_POST['nip']);
    $idcuti           = mysqli_real_escape_string($conn,$_POST['idcuti']);
    $tanggalmulai     = mysqli_real_escape_string($conn,$_POST['tanggalmulai']);
    $lamacuti         = mysqli_real_escape_string($conn,$_POST['lamacuti']);
    $alasancuti       = mysqli_real_escape_string($conn,$_POST['alasancuti']);

    $tanggalpengajuan = date("Y-m-d");

    $status = "Pending";

    // Cek NIP
    $cek = mysqli_query($conn,"
        SELECT *
        FROM karyawan
        WHERE nip='$nip'
    ");

    if(mysqli_num_rows($cek)==0){

        header("Location:index.php?status=gagal");
        exit;

    }
// Generate ID Pengajuan Cuti
$query = mysqli_query($conn,"
SELECT MAX(idpengajuancuti) AS terakhir
FROM pengajuancuti
");

$data = mysqli_fetch_assoc($query);

$nomor = 1;

if($data['terakhir'] != ""){

    $nomor = (int)substr($data['terakhir'],2) + 1;

}

$idpengajuancuti = "PC".str_pad($nomor,3,"0",STR_PAD_LEFT);
    // Simpan Pengajuan
    $simpan = mysqli_query($conn,"
        INSERT INTO pengajuancuti
        (
            idpengajuancuti,
            nip,
            idcuti,
            tanggalpengajuan,
            tanggalmulai,
            lamacuti,
            alasancuti,
            status
        )
        VALUES
        (
            '$idpengajuancuti',
            '$nip',
            '$idcuti',
            '$tanggalpengajuan',
            '$tanggalmulai',
            '$lamacuti',
            '$alasancuti',
            '$status'
        )
    ");

    if($simpan){

        header("Location:index.php?status=sukses");

    }else{

        header("Location:index.php?status=gagal");

    }

    exit;

}
if(isset($_POST['hapus'])){

    $id = mysqli_real_escape_string($conn,$_POST['hapus']);

    $hapus = mysqli_query($conn,"
        DELETE
        FROM pengajuancuti
        WHERE idpengajuancuti='$id'
    ");

    if($hapus){

        echo json_encode([
            "status"=>"success",
            "message"=>"Data pengajuan cuti berhasil dihapus."
        ]);

    }else{

        echo json_encode([
            "status"=>"error",
            "message"=>"Data gagal dihapus."
        ]);

    }

    exit;

}