<?php

include "../function/koneksi.php";

if($_SESSION['level']=="Administrator"){

    $qNotif=mysqli_query($conn,"
    SELECT COUNT(*) total
    FROM pengajuancuti
    WHERE status='Pending'
    ");

}else{

    $nip=$_SESSION['nip'];

    $qNotif=mysqli_query($conn,"
    SELECT COUNT(*) total
    FROM pengajuancuti
    WHERE nip='$nip'
    AND status<>'Pending'
    ");

}

$notif=mysqli_fetch_assoc($qNotif);

?>

<div class="topbar">

    <div class="topbar-left">

        <button class="menu-toggle">

            <i class="fa-solid fa-bars"></i>

        </button>

        <div class="page-title">

            <h2>Dashboard</h2>

            <p>Selamat datang di Sistem Cuti Online</p>

        </div>

    </div>

    <div class="topbar-right">

        <div class="search-box">

            <i class="fa-solid fa-magnifying-glass"></i>

            <input
            type="text"
            placeholder="Cari sesuatu...">

        </div>


        <!-- USER -->

        <div class="user-menu">

            <img src="../img/avatar_small.png">

            <div class="user-info">

                <h4><?= $_SESSION['nama']; ?></h4>

                <span><?= $_SESSION['level']; ?></span>

            </div>

            <i class="fa-solid fa-angle-down"></i>

        </div>

    </div>

</div>