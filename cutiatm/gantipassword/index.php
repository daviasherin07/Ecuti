<?php
session_start();

include "../template/header.php";
?>

<div class="wrapper">

<?php include "../template/sidebar.php"; ?>

<div class="content">

<?php include "../template/topbar.php"; ?>

<div class="main-content">

    <div class="page-header">

        <div>

            <h2>Ganti Password</h2>

            <p>

                Ubah password akun administrator.

            </p>

        </div>

    </div>

    <div class="panel">

        <div class="panel-header">

            <h3 class="panel-title">

                Form Ganti Password

            </h3>

        </div>

        <form>

            <div class="form-group">

                <label>Password Lama</label>

                <input
                    type="password"
                    class="form-control"
                    placeholder="Masukkan Password Lama">

            </div>

            <div class="form-group">

                <label>Password Baru</label>

                <input
                    type="password"
                    class="form-control"
                    placeholder="Masukkan Password Baru">

            </div>

            <div class="form-group">

                <label>Konfirmasi Password</label>

                <input
                    type="password"
                    class="form-control"
                    placeholder="Ulangi Password Baru">

            </div>

            <div
                style="
                margin-top:30px;
                display:flex;
                gap:15px;
            ">

                <button
                    class="btn btn-primary">

                    <i class="fa-solid fa-key"></i>

                    Simpan Password

                </button>

                <button
                    type="reset"
                    class="btn btn-secondary">

                    Reset

                </button>

            </div>

        </form>

    </div>

</div>

</div>

<?php include "../template/footer.php"; ?>