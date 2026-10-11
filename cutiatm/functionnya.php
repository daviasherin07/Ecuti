<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);
ini_set('display_errors','0');

function paginate_one($reload, $page, $tpages) {
    $firstlabel = "&laquo;&nbsp;";
    $prevlabel  = "&lsaquo;&nbsp;";
    $nextlabel  = "&nbsp;&rsaquo;";
    $lastlabel  = "&nbsp;&raquo;";

    $out = "<ul class=\"pagination\">";

    if ($page > 1) {
        $out .= "<li><a href=\"" . $reload . "\">" . $firstlabel . "</a></li>";
    } else {
        $out .= "<li><span>" . $firstlabel . "</span></li>";
    }

    if ($page == 1) {
        $out .= "<li><span>" . $prevlabel . "</span></li>";
    } else {
        $pagenyaa = $page - 1;
        $out .= "<li><a class='pagenya' id='$pagenyaa' href='#'>" . $prevlabel . "</a></li>";
    }

    $out .= "<li><span class=\"current\">Page " . $page . " of " . $tpages . "</span></li>";

    if ($page < $tpages) {
        $pagenyaa = $page + 1;
        $out .= "<li><a class='pagenya' id='$pagenyaa' href='#'>" . $nextlabel . "</a></li>";
    } else {
        $out .= "<li><span>" . $nextlabel . "</span></li>";
    }

    if ($page < $tpages) {
        $out .= "<li><a class='pagenya' id='$tpages' href='#'>" . $lastlabel . "</a></li>";
    } else {
        $out .= "<li><span>" . $lastlabel . "</span></li>";
    }

    $out .= "</ul>";
    return $out;
}

function sinkron_session_karyawan() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (empty($_SESSION['username'])) {
        return;
    }

    $username = $_SESSION['username'];

    if ($username == 'admin') {
        $_SESSION['nama'] = 'admin';
        $_SESSION['divisi'] = 'HRD';
        $_SESSION['level'] = 'Admin';
        return;
    }

    $q_user = mysql_query("SELECT * FROM userlogin WHERE username='$username'");
    $d_user = mysql_fetch_assoc($q_user);

    if ($d_user && !empty($d_user['nip'])) {
        $nik = $d_user['nip'];

        $q_karyawan = mysql_query("SELECT * FROM karyawan WHERE nik='$nik'");
        $d_karyawan = mysql_fetch_assoc($q_karyawan);

        if ($d_karyawan) {
            $_SESSION['nip'] = $d_karyawan['nik'];
            $_SESSION['nik'] = $d_karyawan['nik'];
            $_SESSION['nama'] = $d_karyawan['nama'];
            $_SESSION['divisi'] = $d_karyawan['divisi'];
            $_SESSION['level'] = $d_karyawan['level'];

            if (isset($d_karyawan['sisacuti'])) {
                $_SESSION['sisacuti'] = $d_karyawan['sisacuti'];
            }
        }
    }
}

function menunya() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    sinkron_session_karyawan();

    $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
    $divisi   = isset($_SESSION['divisi']) ? $_SESSION['divisi'] : '';
    $level    = isset($_SESSION['level']) ? $_SESSION['level'] : '';

    if ($divisi == 'HRD' || $username == 'admin') {
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
    } else {
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

    <?php if ($level == 'Manager' || $level == 'General Manager' || $level == 'Direktur') { ?>
    <li class="item3"><a href="#">Konfirmasi</a>
        <ul>
            <li class="subitem1"><a href="../print/">Print</a></li>
        </ul>
    </li>
    <?php } ?>

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