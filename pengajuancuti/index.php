<?php
session_start();

if($_SESSION['level']!="Administrator"){
    header("Location:staff.php");
    exit;
}


include "../template/header.php";
?>

<div class="wrapper">

<?php include "../template/sidebar.php"; ?>

<div class="content">

<?php include "../template/topbar.php"; ?>
<?php

if(isset($_GET['status'])){

if($_GET['status']=="sukses"){

?>

<script>

document.addEventListener("DOMContentLoaded",function(){

swal({

title:"Berhasil",

text:"Pengajuan cuti berhasil dikirim.",

type:"success"

});

});

</script>

<?php }

if($_GET['status']=="gagal"){ ?>

<script>

document.addEventListener("DOMContentLoaded",function(){

swal({

title:"Error",

text:"Pengajuan gagal.",

type:"error"

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

            <h2>Pengajuan Cuti</h2>

            <p>

                Kelola seluruh pengajuan cuti pegawai.

            </p>

        </div>

<div class="page-action">

    <a
        href="../cekpengajuancuti/"
        class="btn btn-secondary">

        <i class="fa-solid fa-magnifying-glass"></i>

        Cek Pengajuan

    </a>

</div>

<div class="page-action">

<?php if($_SESSION['level']=="Administrator"){ ?>

<button
id="btnTambahPengajuan"
class="btn btn-primary">

<i class="fa-solid fa-plus"></i>

Ajukan Cuti

</button>

<a
href="print.php"
class="btn btn-secondary">

<i class="fa-solid fa-print"></i>

Cetak

</a>

<?php }else{ ?>

<a
href="../cekpengajuancuti/"
class="btn btn-secondary">

<i class="fa-solid fa-magnifying-glass"></i>

Cek Pengajuan

</a>

<?php } ?>

</div>

    </div>

    <!-- TABLE -->

    <div class="panel">

        <div class="panel-header">

            <h3 class="panel-title">

                Daftar Pengajuan Cuti

            </h3>

        </div>
<div id="data-pengajuan">

<?php include "pengajuancuti.data.php"; ?>

</div>

    </div>

<!-- =====================================
        MODAL PENGAJUAN CUTI
====================================== -->

<div
class="modal fade"
id="modalPengajuan"
tabindex="-1"
role="dialog"
aria-hidden="true">

<div class="modal-dialog modal-lg">

<div class="modal-content">

<form
method="POST"
action="pengajuancuti.input.php">

<div class="modal-header">

<h4 class="modal-title">

<i class="fa-solid fa-paper-plane"></i>

Form Pengajuan Cuti

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

<label>NIP Pegawai</label>

<input
type="text"
name="nip"
class="form-control"
value="<?= $_SESSION['nip']; ?>"
readonly>


</div>

</div>

<div class="col-md-6">

<div class="form-group">


<label>Nama Pegawai</label>

<input
type="text"
name="nama"
class="form-control"
value="<?= $_SESSION['nama']; ?>"
readonly>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Jenis Cuti</label>

<select
name="idcuti"
id="jeniscuti"
class="form-control"
required>

<option value="">-- Pilih Jenis Cuti --</option>

<option value="CT001">Cuti Tahunan</option>

<option value="CT002">Cuti Sakit</option>

<option value="CT003">Cuti Melahirkan</option>

<option value="CT004">Cuti Besar</option>

</select>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Lama Cuti (Hari)</label>

<input
type="number"
name="lamacuti"
id="lama"
class="form-control"
required>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Tanggal Mulai</label>

<input
type="date"
name="tanggalmulai"
id="tgl_mulai"
class="form-control"
required>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Tanggal Selesai</label>

<input
type="date"
id="tgl_selesai"
class="form-control">

</div>

</div>

<div class="col-md-12">

<div class="form-group">

<label>Alasan Cuti</label>

<textarea
name="alasancuti"
id="alasan"
rows="5"
class="form-control"
required></textarea>

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
name="simpan"
class="btn btn-primary">

<i class="fa-solid fa-paper-plane"></i>

Ajukan Cuti

</button>

</div>

</form>

</div>

</div>

</div>

<?php include "../template/footer.php"; ?>
