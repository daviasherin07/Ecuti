<?php

session_start();

include "../function/koneksi.php";

/* ===========================
   HAPUS DATA
=========================== */

if(isset($_POST['hapus'])){

    $nip = mysqli_real_escape_string($conn,$_POST['hapus']);

    $hapus = mysqli_query($conn,"
    DELETE FROM karyawan
    WHERE nip='$nip'
    ");

    mysqli_query($conn,"
    DELETE FROM userlogin
    WHERE nip='$nip'
    ");

    if($hapus){

        echo json_encode([
            "status"=>"success"
        ]);

    }else{

        echo json_encode([
            "status"=>"error"
        ]);

    }

    exit;

}

/* ===========================
   TAMBAH DATA
=========================== */

if(isset($_POST['simpan'])){

    $nip       = mysqli_real_escape_string($conn,$_POST['nip']);
    $nama      = mysqli_real_escape_string($conn,$_POST['nama']);
    $divisi    = mysqli_real_escape_string($conn,$_POST['divisi']);
    $level     = mysqli_real_escape_string($conn,$_POST['level']);
    $sisacuti  = mysqli_real_escape_string($conn,$_POST['sisacuti']);

    $cekNip = mysqli_query($conn,"
    SELECT *
    FROM karyawan
    WHERE nip='$nip'
    ");

    if(mysqli_num_rows($cekNip)>0){

        echo "<script>

        alert('NIP sudah terdaftar');

        window.location='index.php';

        </script>";

        exit;

    }

    $insertKaryawan = mysqli_query($conn,"
    INSERT INTO karyawan
    (
        nip,
        nama,
        divisi,
        level,
        sisacuti
    )
    VALUES
    (
        '$nip',
        '$nama',
        '$divisi',
        '$level',
        '$sisacuti'
    )
    ");

    $insertUser = mysqli_query($conn,"
    INSERT INTO userlogin
    (
        nip,
        password
    )
    VALUES
    (
        '$nip',
        '$nip'
    )
    ");

    if($insertKaryawan && $insertUser){

        header("Location:index.php?status=sukses");
        exit;

    }else{

        die(mysqli_error($conn));

    }

}

/* ===========================
   EDIT DATA
=========================== */

if(isset($_POST['update'])){

    $niplama  = mysqli_real_escape_string($conn,$_POST['niplama']);
    $nip      = mysqli_real_escape_string($conn,$_POST['nip']);
    $nama     = mysqli_real_escape_string($conn,$_POST['nama']);
    $divisi   = mysqli_real_escape_string($conn,$_POST['divisi']);
    $level    = mysqli_real_escape_string($conn,$_POST['level']);
    $sisacuti = mysqli_real_escape_string($conn,$_POST['sisacuti']);

    mysqli_query($conn,"
    UPDATE karyawan
    SET
        nip='$nip',
        nama='$nama',
        divisi='$divisi',
        level='$level',
        sisacuti='$sisacuti'
    WHERE nip='$niplama'
    ");

    mysqli_query($conn,"
    UPDATE userlogin
    SET
        nip='$nip'
    WHERE nip='$niplama'
    ");

    header("Location:index.php?status=update");
    exit;

}