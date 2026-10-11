<?php

include "../function/koneksi.php";

$nip="";

$nama="";

$username="";

$password="";

$divisi="";

$level="Karyawan";

$sisacuti=12;

if(isset($_GET['nip'])){

    $nip=mysqli_real_escape_string($conn,$_GET['nip']);

    $q=mysqli_query($conn,"
    SELECT *
    FROM karyawan
    WHERE nip='$nip'
    ");

    if(mysqli_num_rows($q)>0){

        $d=mysqli_fetch_assoc($q);

        $nama=$d['nama'];
        $username=$d['username'];
        $password=$d['password'];
        $divisi=$d['divisi'];
        $level=$d['level'];
        $sisacuti=$d['sisacuti'];

    }

}

?>

<form
method="POST"
action="karyawan.input.php">

<input
type="hidden"
name="niplama"
value="<?= $nip; ?>">

<div class="form-group">

<label>NIP</label>

<input
type="text"
name="nip"
class="form-control"
value="<?= $nip; ?>"
required>

</div>

<div class="form-group">

<label>Nama</label>

<input
type="text"
name="nama"
class="form-control"
value="<?= $nama; ?>"
required>

</div>

<div class="form-group">

<label>Username</label>

<input
type="text"
name="username"
class="form-control"
value="<?= $username; ?>"
required>

</div>

<div class="form-group">

<label>Password</label>

<input
type="text"
name="password"
class="form-control"
value="<?= $password; ?>"
required>

</div>

<div class="form-group">

<label>Divisi</label>

<input
type="text"
name="divisi"
class="form-control"
value="<?= $divisi; ?>"
required>

</div>

<div class="form-group">

<label>Level</label>

<select
name="level"
class="form-control">

<option value="Administrator" <?= $level=="Administrator"?"selected":""; ?>>Administrator</option>

<option value="General Manager" <?= $level=="General Manager"?"selected":""; ?>>General Manager</option>

<option value="Manager" <?= $level=="Manager"?"selected":""; ?>>Manager</option>

<option value="Karyawan" <?= $level=="Karyawan"?"selected":""; ?>>Karyawan</option>

</select>

</div>

<div class="form-group">

<label>Sisa Cuti</label>

<input
type="number"
name="sisacuti"
class="form-control"
value="<?= $sisacuti; ?>">

</div>

<div class="modal-footer">

<button
type="submit"
name="update"
class="btn btn-primary">

Update

</button>

</div>

</form>