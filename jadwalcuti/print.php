<?php ob_start(); ?>
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
	
<h1 style="text-align: center;">Data Jadwal Cuti Pegawai</h1>
<table border="1" width="100%">
<tr>
	<th>NIK</th>
	<th>Nama</th>
	<th>Tanggal Mulai</th>
	<th>Lama Cuti</th>
	<th>Status</th>
</tr>
<?php
// Load file koneksi.php
include "../function/koneksi.php";
$param = $_GET['keyword']; // Ambil data keyword yang dikirim dengan AJAX
$param2 = $_GET['keyword2'];
// $param =isset($_GET['keyword'])
 //$param2 =isset($_GET['keyword2'])
 
$query = "select pengajuancuti.idpengajuancuti,pengajuancuti.nik,karyawan.nama,pengajuancuti.tanggalmulai,pengajuancuti.lamacuti,pengajuancuti.status from pengajuancuti inner join karyawan on pengajuancuti.nik = karyawan.nik where pengajuancuti.tanggalmulai BETWEEN '$param' AND '$param2'";
$sql = mysqli_query($connect, $query); // Eksekusi/Jalankan query dari variabel $query
$row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql
 
if($row > 0){ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
    while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
       		 echo "<tr>";
        echo "<td style='width:120px'>".$data['nik']."</td>";
        echo "<td>".$data['nama']."</td>";
		echo "<td style='width:120px'>".$data['tanggalmulai']."</td>";
        echo "<td>".$data['lamacuti']."</td>";
        echo "<td style='width:120px'>".$data['status']."</td>";
       
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
$pdf->Output('Data Jadwal Cuti.pdf', 'D');
?>
