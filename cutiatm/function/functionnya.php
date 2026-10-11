<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);
ini_set('display_errors','0');
/*************************************************************************
php easy :: pagination scripts set - Version One
==========================================================================
Author:      php easy code, www.phpeasycode.com
Web Site:    http://www.phpeasycode.com
Contact:     webmaster@phpeasycode.com
*************************************************************************/

function paginate_one($reload, $page, $tpages) {
	
	$firstlabel = "&laquo;&nbsp;";
	$prevlabel  = "&lsaquo;&nbsp;";
	$nextlabel  = "&nbsp;&rsaquo;";
	$lastlabel  = "&nbsp;&raquo;";
	
	$out = "<ul class=\"pagination\">";
	
	// first
	if($page>1) {
		$out.= "<li><a href=\"" . $reload . "\">" . $firstlabel . "</a></li>";
             $out.= "<li><a class='pagenya' id ='$1' href='#'>" . $firstlabel . "</a></li>";
	}
	else {
		$out.= "<li><span>" . $firstlabel . "</span></li>";
                $out.= "<li><a class='pagenya' id ='$1' href='#'>" . $firstlabel . "</a></li>";
	}
	
	// previous
	if($page==1) {
		$out.= "<li><span>" . $prevlabel . "</span></li>";
	}
	elseif($page==2) {
		$out.= "<li><a href=\"" . $reload . "\">" . $prevlabel . "</a></li>";
           $pagenyaa=($page - 1);
            $out.= "<li><a class='pagenya' id ='$pagenyaa' href='#'>" . $prevlabel . "</a></li>"; 
	}
	else {
		$out.= "<li><a href=\"" . $reload . "&amp;page=" . ($page-1) . "\">" . $prevlabel . "</a></li>";
           $pagenyaa=($page - 1);
            $out.= "<li><a class='pagenya' id ='$pagenyaa' href='#'>" . $prevlabel . "</a></li>";
	}
	
	// current
	$out.= "<li><span class=\"current\">Page " . $page . " of " . $tpages ."</span></li>";
	
	// next
	if($page<$tpages) {
            $pagenyaa=($page + 1);
		$out.= "<li><a class='pagenya' id ='$pagenyaa' href=\"" . $reload . "&amp;page=" .($page+1) . "\">" . $nextlabel . " </a></li>";
                  $out.= "<li><a class='pagenya' id ='$pagenyaa' href='#'>" . $nextlabel . "</a></li>";
	}
	else {
		$out.= "<li><span>" . $nextlabel . "</span></li>";
	}
	
	// last
	if($page<$tpages) {
		$out.= "<li><a href=\"" . $reload . "&amp;page=" . $tpages . "\">" . $lastlabel . "</a></li>";
              $out.= "<li><a class='pagenya' id ='$tpages' href='#'>" . $lastlabel . "</a></li>";
	}
	else {
		$out.= "<li><span>" . $lastlabel . "</span></li>";
	}
	
	$out.= "</ul>";
	
	return $out;
}

function menunya(){
?>
<?php
if (session_status() === PHP_SESSION_NONE) { if (session_status() === PHP_SESSION_NONE) { session_start(); } }

if($_SESSION['divisi']=='HRD' || $_SESSION['username']=='admin' ){


?>

    <ul class="menu">
        <li class="item2"><a href="#">Master</a>
            <ul>
                <li class="subitem1"><a href="../karyawan/">Tambah Pegawai</a></li>
                <li class="subitem2"><a href="../jeniscuti/">Tambah Jenis Cuti</a></li>
            </ul>
        </li>
        <li class="item2"><a href="#">Cuti</a>
            <ul>
                <li class="subitem1"><a href="../pengajuancuti/">Pengajuan Cuti</a></li>
                <li class="subitem2"><a href="../cekpengajuancuti/">Cek Pengajuan Cuti</a></li>
                <li class="subitem3"><a href="../jadwalcuti/">Lihat Jadwal Cuti</a></li>
                <li class="subitem4"><a href="../sisacuti/">Lihat Sisa Cuti</a></li>
            </ul>
        </li>
        <li class="item3"><a href="#">Konfirmasi</a>
            <ul>
                <li class="subitem1"><a href="../approval/">Approval Cuti</a></li>
                <li class="subitem1"><a href="../cetak.php/">Proses Form Cuti</a></li>
            </ul>
        </li>
        <li class="item5"><a href="#">Pengguna</a>
            <ul>
                <li class="subitem1"><a href="../gantipassword/">Ganti Password</a></li>
            </ul>
        </li>
    </ul>
    <?php                 
}
if($_SESSION['divisi']!='HRD' && $_SESSION['level']=='Staff'){
?>     
<ul class="menu">
        <li class="item2"><a href="#">Cuti</a>
            <ul>
                <li class="subitem1"><a href="../pengajuancuti/">Pengajuan Cuti</a></li>
                <li class="subitem2"><a href="../cekpengajuancuti/">Cek Pengajuan Cuti</a></li>
                <li class="subitem3"><a href="../jadwalcuti/">Lihat Jadwal Cuti</a></li>
                <li class="subitem4"><a href="../sisacuti/">Lihat Sisa Cuti</a></li>
            </ul>
        </li>
        <li class="item5"><a href="#">Pengguna</a>
            <ul>
                <li class="subitem1"><a href="../gantipassword/">Ganti Password</a></li>
            </ul>
        </li>        
        </ul>
    <?php
}
if($_SESSION['divisi']!='HRD' && $_SESSION['level']=='Manager'){


?>     
<ul class="menu">
        <li class="item2"><a href="#">Cuti</a>
            <ul>
                <li class="subitem1"><a href="../pengajuancuti/">Pengajuan Cuti</a></li>
                <li class="subitem2"><a href="../cekpengajuancuti/">Cek Pengajuan Cuti</a></li>
                <li class="subitem3"><a href="../jadwalcuti/">Lihat Jadwal Cuti</a></li>
                <li class="subitem4"><a href="../sisacuti/">Lihat Sisa Cuti</a></li>
            </ul>
        </li>
         <li class="item3"><a href="#">Konfirmasi</a>
            <ul>
                <li class="subitem1"><a href="../print/">Print</a></li>
                
            </ul>
        </li>
        <li class="item5"><a href="#">Pengguna</a>
            <ul>
                <li class="subitem1"><a href="../gantipassword/">Ganti Password</a></li>
            </ul>
        </li>
</ul>
    <?php
}

if($_SESSION['divisi']!='HRD' && $_SESSION['level']=='General Manager'){


?>     
<ul class="menu">
        <li class="item2"><a href="#">Cuti</a>
            <ul>
                <li class="subitem1"><a href="../pengajuancuti/">Pengajuan Cuti</a></li>
                <li class="subitem2"><a href="../cekpengajuancuti/">Cek Pengajuan Cuti</a></li>
                <li class="subitem3"><a href="../jadwalcuti/">Lihat Jadwal Cuti</a></li>
                <li class="subitem4"><a href="../sisacuti/">Lihat Sisa Cuti</a></li>
            </ul>
        </li>
         <li class="item3"><a href="#">Konfirmasi</a>
            <ul>
                <li class="subitem1"><a href="../print/">Print</a></li>
                
            </ul>
        </li>
        <li class="item5"><a href="#">Pengguna</a>
            <ul>
                <li class="subitem1"><a href="../gantipassword/">Ganti Password</a></li>
            </ul>
        </li>
</ul>
    <?php
}
if($_SESSION['level']=='Direktur'){


?>     
<ul class="menu">

         <li class="item3"><a href="#">Konfirmasi</a>
            <ul>
                <li class="subitem1"><a href="../print/">Print</a></li>
                
            </ul>
        </li>
        <li class="item5"><a href="#">Pengguna</a>
            <ul>
                <li class="subitem1"><a href="../gantipassword/">Ganti Password</a></li>
            </ul>
        </li>
</ul>
    <?php
}

}
?>