<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);
ini_set('display_errors','0'); ob_start();
session_start()
?>
<html>
<head>
	<title>Cetak PDF</title>
	<style>
		table {
			border-collapse:collapse; 
			table-layout:fixed;width: 630px;
		}
		table td {
			word-wrap:break-word;
			width: 20%;
		}
	</style>
        <link href="../css/office.css" rel="stylesheet" type="text/css">
    
<link href="../css/theme-cream.css?v=20260626" rel="stylesheet" type="text/css">
</head>
<body>
    <?php
    include "../function/koneksi.php";
        $nik = $_SESSION['username'];
	$query2 = "SELECT * FROM karyawan where nik='$nik'"; // Tampilkan semua data gambar
$sql2 = mysqli_query($connect, $query2); // Eksekusi/Jalankan query dari variabel $query
//$row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql
$data = mysqli_fetch_array($sql2);
        $nama = $data['nama'];
        $divisi = $data['divisi'];
        $sisacuti = $data['sisacuti'];
        
        ?>
<h1 style="text-align: center;">Sisa Cuti Pegawai</h1>

  <table>
  <tr>
    <td> <label style="color: blue;font-size: 20px; font-weight: 200; line-height: 36px;" >Nama</label></td>
    <td> <label style="color: #000000; font-size: 20px; font-weight: 200; line-height: 36px;" ><?php echo $nama; ?></label></td>
   
  </tr>
  <tr>
    <td> <label class="control-label" style="color: blue; font-size: 20px; font-weight: 200; line-height: 36px;" >Divisi</label></td>
    <td> <label class="control-label" style="color: #000000; font-size: 20px; font-weight: 200; line-height: 36px;" ><?php echo $divisi; ?></label></td>
  </tr>
  <tr>
    <td> <label class="control-label" style="color: blue; font-size: 20px; font-weight: 200; line-height: 36px;" >Sisa Cuti</label></td>
    <td> <label class="control-label" style="color: 000000;  font-size: 20px; font-weight: 200; line-height: 36px;" ><?php echo $sisacuti; ?></label></td>
  </tr>
    </table>
<table border="1" width="100%">
<tr>
	<th>Tanggal Cuti</th>
	<th>Lama Hari</th>
	<th>Alasan Cuti</th>

</tr>
<?php
 //Load file koneksi.php
//include "../function/koneksi.php";
$nik = $_SESSION['username'];
$query ="SELECT * FROM pengajuancuti where nik='$nik' and status='Success' order by nik desc";
			
//$query = "SELECT * FROM karyawan where nik='$nik'"; // Tampilkan semua data gambar
$sql = mysqli_query($connect, $query); // Eksekusi/Jalankan query dari variabel $query
$row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql

        $nama = $data['tanggalmulai'];
        $divisi = $data['lamacuti'];
        $sisacuti = $data['alasancuti'];
 ?>
  
<?php
if($row > 0){ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
    while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
        echo "<tr>";
        echo "<td>".$data['tanggalmulai']."</td>";
        echo "<td>".$data['lamacuti']."</td>";
        echo "<td>".$data['alasancuti']."</td>";
        echo "</tr>";
    }
}else{ // Jika data tidak ada
    echo "<tr><td colspan='4'>Data tidak ada</td></tr>";
}
?>
</table>





</body>
</html>
<?php
$html = ob_get_contents();
ob_end_clean();
        
require_once('../html2pdf/html2pdf.class.php');
$pdf = new HTML2PDF('P','A4','en');
$pdf->WriteHTML($html);
$pdf->Output('Sisa Cuti Pegawai.pdf', 'D');
?>
