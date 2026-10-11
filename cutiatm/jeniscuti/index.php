<?php
session_start();

include "../template/header.php";
?>

<div class="wrapper">

<?php include "../template/sidebar.php"; ?>

<div class="content">

<?php include "../template/topbar.php"; ?>

<div class="main-content">

    <!-- =====================================
            PAGE HEADER
    ====================================== -->

    <div class="page-header">

        <div>

            <h2>Jenis Cuti</h2>

            <p>

                Kelola seluruh jenis cuti perusahaan.

            </p>

        </div>

        <div class="page-action">

            <button
                type="button"
                id="btnTambahJenisCuti"
                class="btn btn-primary"
                data-toggle="modal"
                data-target="#modalJenisCuti">

                <i class="fa-solid fa-plus"></i>

                Tambah Jenis Cuti

            </button>

            <a
                href="print.php"
                class="btn btn-secondary">

                <i class="fa-solid fa-print"></i>

                Cetak

            </a>

        </div>

    </div>

    <!-- SEARCH -->

    <div class="search-wrapper">

        <div class="search-box">

            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                type="text"
                placeholder="Cari Jenis Cuti...">

        </div>

    </div>

    <!-- TABLE -->

    <div class="panel">

        <div class="panel-header">

            <h3 class="panel-title">

                Daftar Jenis Cuti

            </h3>

        </div>

<div id="data-jeniscuti">

<?php include "jeniscuti.data.php"; ?>

</div>

    </div>
  <!-- =====================================
        MODAL TAMBAH JENIS CUTI
===================================== -->

<div
class="modal fade"
id="modalJenisCuti"
tabindex="-1"
role="dialog"
aria-hidden="true">

<div class="modal-dialog">

<div class="modal-content">
<?php

$edit=false;

$idlama="";

$idcuti="";

$jeniscuti="";

if(isset($_GET['edit'])){

$edit=true;

$id=$_GET['edit'];

$q=mysqli_query($conn,"
SELECT *
FROM jeniscuti
WHERE idcuti='$id'
");

$r=mysqli_fetch_assoc($q);

$idlama=$r['idcuti'];

$idcuti=$r['idcuti'];

$jeniscuti=$r['jeniscuti'];

}

?>
<form
method="POST"
action="jeniscuti.input.php">

<div class="modal-header">

<h4 class="modal-title">

<i class="fa-solid fa-calendar-plus"></i>

Tambah Jenis Cuti

</h4>

<button
type="button"
class="close"
data-dismiss="modal">

&times;

</button>

</div>

<div class="modal-body">

<div class="form-group">

<label>ID Jenis Cuti</label>

<input
type="text"
name="idcuti"
value="<?= $idcuti; ?>"
class="form-control"
placeholder="Contoh : CT004"
required>

</div>

<div class="form-group">

<label>Nama Jenis Cuti</label>

<input
type="text"
name="jeniscuti"
class="form-control"
required>

</div>

</div>

<div class="modal-footer">

<button
type="button"
class="btn btn-secondary"
data-dismiss="modal">

Batal

</button>

<button
type="submit"
name="simpan"
class="btn btn-primary">

<i class="fa-solid fa-floppy-disk"></i>

Simpan

</button>

</div>

</form>

</div>

</div>

</div>

<?php include "../template/footer.php"; ?>