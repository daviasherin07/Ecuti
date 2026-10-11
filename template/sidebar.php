<div class="sidebar">

    <!-- =========================
         LOGO
    ========================== -->

    <div class="sidebar-logo">

        <div class="logo-icon">
            <i class="fa-solid fa-calendar-check"></i>
        </div>

        <div class="logo-text">
            <h2>SISTEM CUTI</h2>
            <span>Artha Teknologi</span>
        </div>

    </div>

    <!-- =========================
         PROFILE
    ========================== -->

    <div class="sidebar-profile">

        <img src="../img/avatar_small.png" alt="User">

        <div>

            <h3><?= $_SESSION['nama']; ?></h3>

            <span><?= $_SESSION['level']; ?></span>

        </div>

    </div>

    <!-- =========================
         MENU
    ========================== -->

    <div class="sidebar-menu">

    <?php if($_SESSION['level']=="Administrator"){ ?>

        <p class="menu-title">
            MENU UTAMA
        </p>

        <ul>

            <li>

                <a href="../dashboard/">

                    <span>

                        <i class="fa-solid fa-house"></i>

                        Dashboard

                    </span>

                </a>

            </li>

            <li class="dropdown">

                <a href="#" class="dropdown-toggle">

                    <span>

                        <i class="fa-solid fa-layer-group"></i>

                        Master Data

                    </span>

                    <i class="fa-solid fa-chevron-down arrow"></i>

                </a>

                <ul class="submenu">

                    <li>

                        <a href="../karyawan/">

                            Data Pegawai

                        </a>

                    </li>

                    <li>

                        <a href="../jeniscuti/">

                            Jenis Cuti

                        </a>

                    </li>

                    <li>

                        <a href="../jadwalcuti/">

                            Hari Libur

                        </a>

                    </li>

                </ul>

            </li>

            <li>

                <a href="../pengajuancuti/">

                    <span>

                        <i class="fa-solid fa-file-circle-plus"></i>

                        Pengajuan Cuti

                    </span>

                </a>

            </li>

            <li>

                <a href="../approval/">

                    <span>

                        <i class="fa-solid fa-circle-check"></i>

                        Approval Cuti

                    </span>

                </a>

            </li>

            <li>

                <a href="../cekpengajuancuti/">

                    <span>

                        <i class="fa-solid fa-magnifying-glass"></i>

                        Cek Pengajuan

                    </span>

                </a>

            </li>

        </ul>

        <p class="menu-title">

            AKUN

        </p>

        <ul>

            <li>

                <a href="../gantipassword/">

                    <span>

                        <i class="fa-solid fa-key"></i>

                        Ganti Password

                    </span>

                </a>

            </li>

            <li>

                <a href="../logout.php">

                    <span>

                        <i class="fa-solid fa-right-from-bracket"></i>

                        Logout

                    </span>

                </a>

            </li>

        </ul>

    <?php }else{ ?>

        <p class="menu-title">

            CUTI

        </p>

        <ul>

            <li>

                <a href="../pengajuancuti/">

                    <span>

                        <i class="fa-solid fa-paper-plane"></i>

                        Pengajuan Cuti

                    </span>

                </a>

            </li>

            <li>

                <a href="../cekpengajuancuti/">

                    <span>

                        <i class="fa-solid fa-magnifying-glass"></i>

                        Cek Pengajuan

                    </span>

                </a>

            </li>

            <li>

                <a href="../sisacuti/">

                    <span>

                        <i class="fa-solid fa-hourglass-half"></i>

                        Sisa Cuti

                    </span>

                </a>

            </li>

        </ul>

        <p class="menu-title">

            AKUN

        </p>

        <ul>

            <li>

                <a href="../gantipassword/">

                    <span>

                        <i class="fa-solid fa-key"></i>

                        Ganti Password

                    </span>

                </a>

            </li>

            <li>

                <a href="../logout.php">

                    <span>

                        <i class="fa-solid fa-right-from-bracket"></i>

                        Logout

                    </span>

                </a>

            </li>

        </ul>

    <?php } ?>

    </div>

    <!-- =========================
         FOOTER
    ========================== -->

    <div class="sidebar-footer">

        <small>

            Sistem Cuti Online v2.0

        </small>

    </div>

</div>