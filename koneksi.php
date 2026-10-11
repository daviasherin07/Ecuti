<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);
ini_set('display_errors','0');
define('DB_NAMA', 'dbcuti'); // sesuaikan dengan nama database anda
define('DB_USER', 'root'); // sesuaikan dengan nama pengguna database anda
define('DB_PASSWORD', ''); // sesuaikan dengan kata sandi database anda
define('DB_HOST', 'localhost'); // ganti jika letak database mysql di komputer lain

// fungsi untuk melakukan koneksi ke database mysql
function koneksi_buka() {
	mysql_select_db(DB_NAMA,mysql_connect(DB_HOST,DB_USER,DB_PASSWORD));
}
$connect = mysqli_connect("localhost", "root", "", "dbcuti");
// fungsi untuk menutup koneksi ke database mysql
function koneksi_tutup() {
	mysql_close(mysql_connect(DB_HOST,DB_USER,DB_PASSWORD));
}
?>
