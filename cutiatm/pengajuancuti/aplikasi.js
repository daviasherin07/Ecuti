$(document).ready(function(){

    var main="pengajuancuti.data.php";

    loadData();

    function loadData(){

        $("#data-pengajuan").load(main);

    }

    /* ==========================
       SEARCH
    ========================== */

    $("#keyword").keyup(function(){

        var key=$(this).val();

        $("#data-pengajuan").load(

            "search.php?keyword="+encodeURIComponent(key)

        );

    });

    /* ==========================
       HAPUS
    ========================== */

    $(document).on("click",".hapus",function(e){

        e.preventDefault();

        var id=$(this).attr("id");

        swal({

            title:"Hapus data?",

            text:"Data yang dihapus tidak dapat dikembalikan.",

            type:"warning",

            showCancelButton:true,

            confirmButtonText:"Ya",

            cancelButtonText:"Batal"

        },function(isConfirm){

            if(isConfirm){

                $.ajax({

                    url:"pengajuancuti.input.php",

                    type:"POST",

                    dataType:"json",

                    data:{

                        hapus:id

                    },

                    success:function(r){

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

});