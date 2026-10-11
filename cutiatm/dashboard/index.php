<?php
session_start();
include "../template/header.php";
?>

<div class="wrapper">

<?php include "../template/sidebar.php"; ?>

<div class="content">

<?php include "../template/topbar.php"; ?>
<?php

include "../function/koneksi.php";

// ==============================
// TOTAL PEGAWAI
// ==============================

$qPegawai = mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM karyawan
");

$totalPegawai = mysqli_fetch_assoc($qPegawai)['total'];


// ==============================
// TOTAL PENGAJUAN CUTI
// ==============================

$qPengajuan = mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM pengajuancuti
");

$totalPengajuan = mysqli_fetch_assoc($qPengajuan)['total'];


// ==============================
// APPROVAL (STATUS PENDING)
// ==============================

$qPending = mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM pengajuancuti
WHERE status='Pending'
");

$totalPending = mysqli_fetch_assoc($qPending)['total'];


// ==============================
// TOTAL DIVISI
// ==============================

$qDivisi = mysqli_query($conn,"
SELECT COUNT(DISTINCT divisi) AS total
FROM karyawan
");

$totalDivisi = mysqli_fetch_assoc($qDivisi)['total'];


// ==============================
// PEGAWAI AKTIF
// ==============================

$qAktif = mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM karyawan
");

$totalAktif = mysqli_fetch_assoc($qAktif)['total'];


// ==============================
// TOTAL SISA CUTI
// ==============================

$qSisa = mysqli_query($conn,"
SELECT SUM(sisacuti) AS total
FROM karyawan
");

$dataSisa = mysqli_fetch_assoc($qSisa);

$totalSisa = $dataSisa['total'] ?? 0;

// ==============================
// PENGAJUAN TERBARU
// ==============================

$qTerbaru = mysqli_query($conn,"
SELECT
    p.nip,
    k.nama,
    j.jeniscuti,
    p.status
FROM pengajuancuti p
LEFT JOIN karyawan k
ON p.nip = k.nip
LEFT JOIN jeniscuti j
ON p.idcuti = j.idcuti
ORDER BY p.idpengajuancuti DESC
LIMIT 5
");

// ==============================
// PEGAWAI TERBARU
// ==============================

$qPegawaiBaru = mysqli_query($conn,"
SELECT nama
FROM karyawan
ORDER BY nip DESC
LIMIT 1
");

$pegawaiBaru = mysqli_fetch_assoc($qPegawaiBaru);

// ==============================
// CUTI TERBARU
// ==============================

$qCutiBaru = mysqli_query($conn,"
SELECT
k.nama
FROM pengajuancuti p
LEFT JOIN karyawan k
ON p.nip=k.nip
ORDER BY p.idpengajuancuti DESC
LIMIT 1
");

$cutiBaru = mysqli_fetch_assoc($qCutiBaru);
?>

<div class="main-content">

    <!-- ===============================
            HERO
    ================================ -->

    <section class="hero-section">

        <div class="hero-left">

            <span class="hero-badge">

                Employee Leave Management

            </span>

            <h1>

                Selamat Datang,
                <br>

                <strong>

                <?php
                echo isset($_SESSION['nama'])
                ? $_SESSION['nama']
                : "Administrator";
                ?>

                </strong>

                👋

            </h1>

            <p>

               Kelola data pegawai, pengajuan cuti,
                approval, serta hari libur
                dalam satu dashboard modern.

            </p>

            <div class="hero-button">

                <a
                    href="../karyawan/"
                    class="btn btn-primary">

                    <i class="fa-solid fa-user-plus"></i>

                    Tambah Pegawai

                </a>

                <a
                    href="../pengajuancuti/"
                    class="btn btn-secondary">

                    <i class="fa-solid fa-file-circle-plus"></i>

                    Ajukan Cuti

                </a>

            </div>

        </div>

    </section>

    <!-- ===============================
            CARD
    ================================ -->

    <section class="dashboard-card">

        <div class="card-box">

            <div class="card-top">

                <div>

                    <p>Total Pegawai</p>

                  <h3><?= $totalPegawai ?></h3>

                    <span class="card-growth">

                        Total Pegawai

                    </span>

                </div>

                <div class="card-icon icon-brown">

                    <i class="fa-solid fa-users"></i>

                </div>

            </div>

        </div>

        <div class="card-box">

            <div class="card-top">

                <div>

                    <p>Pengajuan Cuti</p>

                 <h3><?= $totalPengajuan ?></h3>

                    <span class="card-growth">

                    Total Pengajuan

                    </span>

                </div>

                <div class="card-icon icon-green">

                    <i class="fa-solid fa-file-circle-plus"></i>

                </div>

            </div>

        </div>

        <div class="card-box">

            <div class="card-top">

                <div>

                    <p>Approval</p>

                   <h3><?= $totalPending ?></h3>

                    <span class="card-growth">

                        Menunggu

                    </span>

                </div>

                <div class="card-icon icon-orange">

                    <i class="fa-solid fa-hourglass-half"></i>

                </div>

            </div>

        </div>


    </section>
    <!-- ===============================
            QUICK ACTION
    ================================ -->

    <section class="quick-menu">

        <a href="../karyawan/" class="quick-item">

            <div class="quick-icon">
                <i class="fa-solid fa-users"></i>
            </div>

            <h4>Data Pegawai</h4>

            <p>Kelola seluruh data pegawai</p>

        </a>

        <a href="../jeniscuti/" class="quick-item">

            <div class="quick-icon">
                <i class="fa-solid fa-layer-group"></i>
            </div>

            <h4>Jenis Cuti</h4>

            <p>Master jenis cuti</p>

        </a>

        <a href="../jadwalcuti/" class="quick-item">

            <div class="quick-icon">
                <i class="fa-solid fa-calendar-days"></i>
            </div>

            <h4>Hari Libur</h4>

            <p>Hari libur nasional</p>

        </a>


    </section>


    <!-- ===============================
            CONTENT
    ================================ -->

    <section class="dashboard-grid">

        <!-- LEFT -->

        <div class="panel">

            <div class="panel-header">

                <h3 class="panel-title">

                    Pengajuan Terbaru

                </h3>

                <a href="../pengajuancuti/" class="panel-link">

                    Lihat Semua

                </a>

            </div>

            <table class="table-modern">

                <thead>

                    <tr>

                        <th>NIP</th>

                        <th>Nama</th>

                        <th>Jenis Cuti</th>

                        <th>Status</th>

                    </tr>

                </thead>

<tbody>

<?php

if(mysqli_num_rows($qTerbaru)>0){

    while($d=mysqli_fetch_assoc($qTerbaru)){

?>

<tr>

<td><?= $d['nip']; ?></td>

<td><?= $d['nama']; ?></td>

<td><?= $d['jeniscuti']; ?></td>

<td>

<?php

if($d['status']=="Pending"){

    echo '<span class="status status-warning">Pending</span>';

}else if($d['status']=="Disetujui"){

    echo '<span class="status status-success">Disetujui</span>';

}else{

    echo '<span class="status status-danger">Ditolak</span>';

}

?>

</td>

</tr>

<?php

    }

}else{

?>

<tr>

<td colspan="4" style="text-align:center">

Belum ada data pengajuan cuti.

</td>

</tr>

<?php

}

?>

</tbody>

            </table>

        </div>


        <!-- RIGHT -->

        <div class="panel">

            <div class="panel-header">

                <h3 class="panel-title">

                    Aktivitas

                </h3>

            </div>

            <div class="activity">

                <div class="activity-icon">

                    <i class="fa-solid fa-user-plus"></i>

                </div>

                <div class="activity-text">

                    <h5>Pegawai Baru</h5>

                    <span>

                   <?= $pegawaiBaru['nama'] ?? '-'; ?>

                   ditambahkan

                    </span>

                </div>

            </div>

            <div class="activity">

                <div class="activity-icon">

                    <i class="fa-solid fa-circle-check"></i>

                </div>

                <div class="activity-text">

                    <h5>Cuti Disetujui</h5>

                    <span>Hari ini 11.15</span>

                </div>

            </div>

            <div class="activity">

                <div class="activity-icon">

                    <i class="fa-solid fa-file-circle-plus"></i>

                </div>

                <div class="activity-text">

                    <h5>Pengajuan Baru</h5>

                    <span>

                <?= $cutiBaru['nama'] ?? '-'; ?>

                mengajukan cuti

                </span>

                </div>

            </div>

            <div class="activity">

                <div class="activity-icon">

                    <i class="fa-solid fa-calendar-days"></i>

                </div>

                <div class="activity-text">

                    <h5>Hari Libur Ditambah</h5>

                    <span>Kemarin</span>

                </div>

            </div>

        </div>

    </section>
        <!-- =====================================
                RINGKASAN
    ====================================== -->

    <section
        style="
        display:grid;
        grid-template-columns:repeat(3,1fr);
        gap:22px;
        margin-top:30px;
    ">

        <div class="panel">

            <div class="panel-header">

                <h3 class="panel-title">

                    Total Divisi

                </h3>

            </div>

            <h1
                style="
                font-size:46px;
                color:var(--primary);
                margin-bottom:10px;
            ">

           <?= $totalDivisi ?>

            </h1>

            <p>

                Divisi aktif yang terdaftar
                dalam sistem.

            </p>

        </div>

        <div class="panel">

            <div class="panel-header">

                <h3 class="panel-title">

                    Pegawai Aktif

                </h3>

            </div>

            <h1
                style="
                font-size:46px;
                color:var(--success);
                margin-bottom:10px;
            ">

            <?= $totalAktif ?>

            </h1>

            <p>

                Seluruh pegawai aktif
                perusahaan.

            </p>

        </div>

        <div class="panel">

            <div class="panel-header">

                <h3 class="panel-title">

                    Total Sisa Cuti

                </h3>

            </div>

            <h1
                style="
                font-size:46px;
                color:var(--warning);
                margin-bottom:10px;
            ">

          <?= $totalSisa ?>

            </h1>

            <p>

                Akumulasi sisa cuti
                seluruh pegawai.

            </p>

        </div>

    </section>

</div>

</div>

<?php include "../template/footer.php"; ?>