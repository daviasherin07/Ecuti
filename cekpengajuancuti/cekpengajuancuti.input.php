<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);
ini_set('display_errors','0');
require '../function/koneksi.php';

// buat koneksi ke database mysql
koneksi_buka();

// proses menghapus data mahasiswa

 //   mysql_query("DELETE FROM karyawan WHERE nik=".$_POST['hapus']);
	// deklarasikan variabel
        $idpengajuan = $_POST['id'];
        $nik = $_POST['nik'];
        $tanggalmulai = $_POST['tanggalmulai'];
	$lamacuti = $_POST['lamacuti'];
        $alasancuti = $_POST['alasancuti'];


  
                 mysql_query("update pengajuancuti set tanggalmulai ='$tanggalmulai',lamacuti='$lamacuti',alasancuti='$alasancuti' where nik ='$nik'")  ;


// tutup koneksi ke database mysql
koneksi_tutup();

?>
