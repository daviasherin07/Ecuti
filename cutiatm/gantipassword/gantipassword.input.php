<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);
ini_set('display_errors','0');
require '../function/koneksi.php';
if (session_status() === PHP_SESSION_NONE) { session_start(); }
// buat koneksi ke database mysql
koneksi_buka();

 $password 	= $_POST['passwordbaru'];
 $username	=  $_SESSION['username'];	
mysql_query("update userlogin set password ='$password' where username ='$username'")  ;

// tutup koneksi ke database mysql
koneksi_tutup();

?>
