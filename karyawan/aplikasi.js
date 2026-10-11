$(document).ready(function () {

    var main = "karyawan.data.php";
    var id = 0;

    loadData();
/* ==========================
   TOMBOL TAMBAH
========================== */

$(document).on("click", "#btnTambahPegawai", function (e) {

    e.preventDefault();

    document.getElementById("modalPegawai").style.display="block";

});

    function loadData() {
        $("#data-karyawan").load(main);
    }

    /* ==========================
       TOMBOL TAMBAH
    ========================== */

    $(document).on("click", ".tambah", function () {

        id = 0;

        $("#nik").val("");
        $("#nama").val("");
        $("#divisi").val("");
        $("#level").val("");
        $("#sisacuti").val("12");

    });

    /* ==========================
       SIMPAN
    ========================== */

    $(document).on("click", "#simpan-karyawan", function () {

        var nik = $("#nik").val();
        var nama = $("#nama").val();
        var divisi = $("#divisi").val();
        var level = $("#level").val();
        var sisacuti = $("#sisacuti").val();

        if (nik == "" || nama == "" || divisi == "") {

            swal(
                "Oops!",
                "Semua data wajib diisi.",
                "warning"
            );

            return false;
        }

        $.ajax({

            url: "karyawan.input.php",

            type: "POST",

            dataType: "json",

            data: {

                id: id,
                nik: nik,
                nama: nama,
                divisi: divisi,
                levelkaryawan: level,
                sisacuti: sisacuti

            },

            beforeSend: function () {

                $("#simpan-karyawan")
                    .prop("disabled", true)
                    .text("Menyimpan...");

            },

            success: function (r) {

                $("#simpan-karyawan")
                    .prop("disabled", false)
                    .text("Simpan");

                if (r.status == "success") {

                    swal(
                        "Berhasil",
                        r.message,
                        "success"
                    );

                    $("#dialog-karyawan").modal("hide");

                    $("#nik").val("");
                    $("#nama").val("");
                    $("#divisi").val("");
                    $("#level").val("");
                    $("#sisacuti").val("12");

                    loadData();

                } else {

                    swal(
                        "Gagal",
                        r.message,
                        "error"
                    );

                }

            },

            error: function () {

                $("#simpan-karyawan")
                    .prop("disabled", false)
                    .text("Simpan");

                swal(
                    "Error",
                    "Terjadi kesalahan server.",
                    "error"
                );

            }

        });

    });

    /* ==========================
       HAPUS
    ========================== */

    $(document).on("click", ".hapus", function (e) {

        e.preventDefault();

        var nik = $(this).attr("id");

        swal({

                title: "Hapus Data?",

                text: "Data yang dihapus tidak dapat dikembalikan.",

                type: "warning",

                showCancelButton: true,

                confirmButtonText: "Ya",

                cancelButtonText: "Batal"

            },

            function (isConfirm) {

                if (isConfirm) {

                    $.ajax({

                        url: "karyawan.input.php",

                        type: "POST",

                        dataType: "json",

                        data: {

                            hapus: nik

                        },

                        success: function (r) {

                            swal(
                                "Berhasil",
                                r.message,
                                "success"
                            );

                            loadData();

                        }

                    });

                }

            });

    });

    /* ==========================
       SEARCH
    ========================== */

    $("#keyword").keyup(function () {

        var key = $(this).val();

        $("#data-karyawan").load(

            "karyawan.datacari.php?keyword=" + encodeURIComponent(key)

        );

    });
/*=================================
DRAG MODAL
=================================*/

$('#modalPegawai').on('shown.bs.modal', function () {

    var modal = $(this).find('.modal-dialog');
    var header = $(this).find('.modal-header');

    modal.css({
        position: 'fixed',
        margin: 0
    });

    var dragging = false;
    var offsetX = 0;
    var offsetY = 0;

    header.css("cursor", "move");

    header.off("mousedown").on("mousedown", function(e){

        dragging = true;

        offsetX = e.pageX - modal.offset().left;
        offsetY = e.pageY - modal.offset().top;

    });

    $(document).off("mousemove.drag").on("mousemove.drag", function(e){

        if(!dragging) return;

        modal.offset({
            left: e.pageX - offsetX,
            top: e.pageY - offsetY
        });

    });

    $(document).off("mouseup.drag").on("mouseup.drag", function(){

        dragging = false;

    });

});
});