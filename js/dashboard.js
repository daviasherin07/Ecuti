document.addEventListener("DOMContentLoaded", function () {

    const dropdowns = document.querySelectorAll(".dropdown");

    dropdowns.forEach(item => {

        const toggle = item.querySelector(".dropdown-toggle");

        if (toggle) {

            toggle.addEventListener("click", function (e) {

                e.preventDefault();

                item.classList.toggle("active");

            });

        }

    });

});

$(function () {

    // ==========================
    // MODAL PEGAWAI
    // ==========================

    $(document).on("click", "#btnTambahPegawai", function (e) {

        e.preventDefault();

        $("#modalPegawai").modal("show");

    });

    // ==========================
    // MODAL JENIS CUTI
    // ==========================

    $(document).on("click", "#btnTambahJenisCuti", function (e) {

        e.preventDefault();

        $("#modalJenisCuti").modal("show");

    });

    // ==========================
    // MODAL HARI LIBUR
    // ==========================

    $(document).on("click", "#btnTambahHariLibur", function (e) {

        e.preventDefault();

        $("#modalHariLibur").modal("show");

    });

    // ==========================
    // MODAL PENGAJUAN CUTI
    // ==========================

    $(document).on("click", "#btnTambahPengajuan", function (e) {

        e.preventDefault();

        $("#modalPengajuan").modal("show");

    });

    // ==========================
    // MODAL BISA DIGESER
    // ==========================

    $(".modal-dialog").draggable({

        handle: ".modal-header"

    });

});
// ===============================
// HAPUS PEGAWAI
// ===============================

$(document).on("click",".hapus",function(){

    if(!confirm("Yakin ingin menghapus data ini?")){

        return;

    }

    let nip=$(this).data("id");

    $.post("karyawan.input.php",{

        hapus:nip

    },function(){

        location.reload();

    });

});