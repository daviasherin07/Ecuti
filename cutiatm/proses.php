<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);
ini_set('display_errors','0');
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if(isset($_SESSION['karyawan'])){
$niks	= $_SESSION['karyawan'];
include('cn.php');
?>
        
        
	   <?php 
       if(isset($_POST['proses'])){
			$nik=$_POST["nik"];
			$divisi=$_POST["divisi"];
			$no_cuti=$_POST['no_cuti'];
			$jenis_cuti=$_POST['jenis_cuti'];
			$tgl_entry=$_POST['tgl_entry'];
			$tgl_cuti=$_POST['tgl_cuti'];
			$jml_cuti=$_POST['jml_cuti'];
			$jml_akhircuti=$_POST['jml_akhircuti'];
			$keterangan=$_POST['keterangan'];
			$status=0;
			
			
			$query=mysql_query("insert into pengajuan  values('$nik','$divisi','$no_cuti','$jenis_cuti','$tgl_entry','$tgl_cuti','$jml_cuti','$jml_akhircuti','$keterangan','','$status')");

		if($query){
			?>
			<script language="javascript">
			alert("Data Berhasil Disimpan!");
			document.location.href='pengajuan.php';
			</script>
			<?php
		}else{
			echo mysql_error();
		}

			
		} elseif(isset($_POST['update_cuti'])) {
			$keterangan=$_POST['keterangan'];
			$sql = "update pengajuan set Keterangan_Tambahan='$keterangan' where NIK='$niks'";
			mysql_query($sql);
			header('Location: pengajuan.php');
			exit;
		}
	}
			
			 ?>
			