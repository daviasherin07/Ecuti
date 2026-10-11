<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);
ini_set('display_errors','0'); ob_start(); ?>
<?php
require '../function/koneksi.php';
 if (session_status() === PHP_SESSION_NONE) { session_start(); }
// buat koneksi ke database mysql
koneksi_buka();

$idnya = mysql_query("select * from approvecuti");
$cek = mysql_num_rows($idnya);
if($cek > 0){
$query = "SELECT MAX(idapprovecuti) as max FROM approvecuti";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$budgetNo = $data['max'];
$noUrut = (int) substr($budgetNo, 3, 3);
$noUrut++;
$char = "AP";
$newID = $char ."".sprintf("%03s", $noUrut);
    
    
}else{
// membaca no budgeting terbesar
$newID ="AP001";

}

	$idpengajuan = $_POST['id'];
      //  $nik2	= $_POST['nik'];
	$nama	= $_SESSION['nama'];
	$tanggalmulai	= $_POST['tanggalmulai'];
	//$levelkaryawan = $_POST['levelkaryawan'];
       // $sisacuti = $_POST['sisacuti'];
	


                        $tanggalnya = date("Y-m-d", strtotime($tanggalmulai));
			mysql_query("INSERT INTO approvecuti VALUES('$newID','$idpengajuan','$tanggalnya','$nama')");
                        mysql_query("update pengajuancuti set status ='Approve' where idpengajuancuti ='$idpengajuan'")  ;
	

// tutup koneksi ke database mysql
koneksi_tutup();

?>

<?php ob_flush(); ?>