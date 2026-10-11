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

$edit=false;

$niplama="";
$nip="";
$nama="";
$divisi="";
$level="";
$sisacuti=12;

if(isset($_GET['edit'])){

    $edit=true;

    $id=$_GET['edit'];

    $q=mysqli_query($conn,"
    SELECT *
    FROM karyawan
    WHERE nip='$id'
    ");

    $r=mysqli_fetch_assoc($q);

    $niplama=$r['nip'];
    $nip=$r['nip'];
    $nama=$r['nama'];
    $divisi=$r['divisi'];
    $level=$r['level'];
    $sisacuti=$r['sisacuti'];

}
?>
<?php

if(isset($_GET['status'])){

if($_GET['status']=="sukses"){

?>

<script>

document.addEventListener("DOMContentLoaded",function(){

Swal.fire({

icon:"success",

title:"Berhasil",

text:"Data pegawai berhasil disimpan"

});

});

</script>

<?php }

}

?>

<div class="main-content">
    <!-- =====================================
            PAGE HEADER
    ====================================== -->

    <div class="page-header">

        <div>

            <h2>Data Pegawai</h2>

            <p>

                Kelola seluruh data pegawai perusahaan.

            </p>

        </div>

        <div class="page-action">

            <button
                type="button"
                id="btnTambahPegawai"
                class="btn btn-primary">

                <i class="fa-solid fa-plus"></i>

                Tambah Pegawai

            </button>

            <a
                href="print.php"
                class="btn btn-secondary">

                <i class="fa-solid fa-print"></i>

                Cetak Data

            </a>

        </div>

    </div>

    <!-- =====================================
            SEARCH
    ====================================== -->

<form method="GET">

<div class="search-wrapper">

<div class="search-box">

<i class="fa-solid fa-magnifying-glass"></i>

<input
type="text"
name="keyword"
placeholder="Cari NIP, Nama Pegawai, atau Divisi..."
value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">

<button
type="submit"
class="btn btn-primary">

Cari

</button>

</div>

</div>

</form>

    <!-- =====================================
            PANEL TABEL
    ====================================== -->

    <div class="panel">

        <div class="panel-header">

            <h3 class="panel-title">

                Daftar Pegawai

            </h3>

        </div>

        <div id="data-karyawan">

<?php include "karyawan.data.php"; ?>

</div>

<div class="pagination">

    <a href="#">

        <i class="fa-solid fa-angle-left"></i>

    </a>

    <a href="#" class="active">

        1

    </a>

    <a href="#">

        2

    </a>

    <a href="#">

        <i class="fa-solid fa-angle-right"></i>

    </a>

</div>

</div>

</div>
<!-- =====================================
        MODAL TAMBAH PEGAWAI
====================================== -->

<!-- =====================================
        MODAL TAMBAH PEGAWAI
====================================== -->

<div
class="modal fade"
id="modalPegawai"
tabindex="-1"
role="dialog"
aria-hidden="true">

<div class="modal-dialog modal-lg">

<div class="modal-content">

<form
method="POST"
action="karyawan.input.php">

<input
type="hidden"
name="niplama"
value="<?= $niplama; ?>">

<div class="modal-header">

<h4 class="modal-title">

<i class="fa-solid fa-user-plus"></i>

<?= $edit ? 'Edit Data Pegawai' : 'Tambah Data Pegawai'; ?>

</h4>

<button
type="button"
class="close"
data-dismiss="modal">

&times;

</button>

</div>

<div class="modal-body">

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>NIP</label>

<input
type="text"
name="nip"
id="nip"
class="form-control"
value="<?= $nip; ?>"
<?= $edit ? 'readonly' : ''; ?>
required>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Nama Pegawai</label>

<input
type="text"
name="nama"
id="nama"
class="form-control"
value="<?= $nama; ?>"
required>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Divisi</label>

<input
type="text"
name="divisi"
id="divisi"
class="form-control"
value="<?= $divisi; ?>"
required>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Level</label>

<select
name="level"
id="level"
class="form-control">

<option value="Administrator" <?= $level=="Administrator"?"selected":""; ?>>Administrator</option>

<option value="Direktur" <?= $level=="Direktur"?"selected":""; ?>>Direktur</option>

<option value="Manager" <?= $level=="Manager"?"selected":""; ?>>Manager</option>

<option value="Sekretaris" <?= $level=="Sekretaris"?"selected":""; ?>>Sekretaris</option>

<option value="Staff" <?= $level=="Staff"?"selected":""; ?>>Staff</option>

</select>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Sisa Cuti</label>

<input
type="number"
name="sisacuti"
id="sisacuti"
class="form-control"
value="<?= $sisacuti; ?>">

</div>

</div>

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
name="<?= $edit ? 'update' : 'simpan'; ?>"
class="btn btn-primary">

<i class="fa-solid fa-floppy-disk"></i>

<?= $edit ? 'Update' : 'Simpan'; ?>

</button>

</div>

</form>
        </div>
    </div>
</div>
</div>
 </div>
 
 <?php if($edit){ ?>

<script>

document.addEventListener("DOMContentLoaded",function(){

$('#modalPegawai').modal('show');

});

</script>

<?php } ?>
<?php include "../template/footer.php"; ?>
