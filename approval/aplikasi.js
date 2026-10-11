var cssId = 'myCss';  // you could encode the css path itself to generate id..
if (!document.getElementById(cssId))
{
    var head  = document.getElementsByTagName('head')[0];
    var link  = document.createElement('link');
    link.id   = cssId;
    link.rel  = 'stylesheet';
    link.type = 'text/css';
    link.href = '../css/style.css';
    link.media = 'all';
    head.appendChild(link);
}

//var imported = document.createElement('script');
//imported.src = '../js/sweetalert-dev.js';
//document.head.appendChild(imported);
(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {
		
		// deklarasikan variabel
		var idpengajuan = "test";
                var page = 0;
             //   var url = "approval.data.php"
                pagenya = this.pagenya
                //pagenya = 7;
		var main = "approval.data.php";
		var maincari = "approval.datacari.php";
		//var main = "approval.data.php?pagination=true&page=" + pagenya;
		// tampilkan data mahasiswa dari berkas mahasiswa.data.php 
		// ke dalam <div id="data-mahasiswa"></div>
		$("#data-approval").load(main);
		$("#caridata-approval").load(maincari);
		// ketika tombol ubah/tambah di tekan
		$('.ubah, .tambah').live("click", function(){
			
			var url = "approval.form.php";
			// ambil nilai id dari tombol ubah
			idpengajuan = this.id;
		
				$("#myModalLabel").html("Approval Cuti");
			

			$.post(url, {id: idpengajuan} ,function(data) {
 $('.statusMsg').html('<span style="color:green;">Data Berhasil Di update</p>');
// tampilkan mahasiswa.form.php ke dalam <div class="modal-body"></div>
				 $('#ui-datepicker-div').appendTo($('.datepicker')); // ini buat kalo abis modal form di close terus openlagi dtpickernya muncul
                                $(".modal-body").html(data).show();
			});
		});
		
		// ketika tombol hapus ditekan
		$('.hapus').live("click", function(){
			var url = "approval.input.php";
			// ambil nilai id dari tombol hapus
			nik = this.id;
			// tampilkan dialog konfirmasi
			var answer = confirm("Apakah anda ingin menghapus data ini?"+nik);
			
			// ketika ditekan tombol ok
			if (answer) {
				// mengirimkan perintah penghapusan ke berkas transaksi.input.php
				$.post(url, {hapus: nik} ,function() {

                                  $("#data-approval").load(main);
				});
			}
		});
		
		// ketika tombol simpan ditekan
		$("#simpan-approval").bind("click", function(event) {
			var url = "approval.input.php";

			// mengambil nilai dari inputbox, textbox dan select
			var v_nik = $('input:text[name=nik]').val();
			var v_nama = $('input:text[name=nama]').val();
			var v_tanggalmulai = $('input:text[name=tanggalmulai]').val();
		 	var v_lamacuti = $('input:text[name=lamacuti]').val();
		        var v_alasancuti = $('input:text[name=sisacuti]').val();
			
                         if(v_nik.trim() == '' ){
                            alert('Masukkan NIK Anda.');
                            return false;
                         }else if(v_nama.trim() == '' ){
                            alert('Masukkan nama Anda.');
                            return false;
                         }else if(v_nama.trim() == '' ){
                            alert('Masukkan nama Anda.');
                            return false;
                         }else if(v_nama.trim() == '' ){
                            alert('Masukkan nama Anda.');
                            return false;
                         }else if(v_nama.trim() == '' ){
                            alert('Masukkan nama Anda.');
                            return false;
                         }
                        // mengirimkan data ke berkas transaksi.input.php untuk di proses
			$.post(url, {nik: v_nik, nama: v_nama, tanggalmulai: v_tanggalmulai, id: idpengajuan, lamacuti: v_lamacuti,alasancuti: v_alasancuti} ,function() {
//$("#myModalLabel").html("Tambah Data approval");
 $('.statusMsg').html('<span style="color:green;">Sukses!</p>');
   $('#nik').val('');
   $('#nama').val('');
   $('#divisi').val('');
   $('#sisacuti').val('');
   
			});

		});
                
                
                // ketika tombol simpan ditekan
		$("#tolak-approval").bind("click", function(event) {
			var url = "approval.input2.php";

			// mengambil nilai dari inputbox, textbox dan select
			var v_nik = $('input:text[name=nik]').val();
			var v_nama = $('input:text[name=nama]').val();
			var v_tanggalmulai = $('input:text[name=tanggalmulai]').val();
		 	var v_lamacuti = $('input:text[name=lamacuti]').val();
		        var v_alasancuti = $('input:text[name=sisacuti]').val();
			
                         if(v_nik.trim() == '' ){
                            alert('Masukkan NIK Anda.');
                            return false;
                         }else if(v_nama.trim() == '' ){
                            alert('Masukkan nama Anda.');
                            return false;
                         }else if(v_nama.trim() == '' ){
                            alert('Masukkan nama Anda.');
                            return false;
                         }else if(v_nama.trim() == '' ){
                            alert('Masukkan nama Anda.');
                            return false;
                         }else if(v_nama.trim() == '' ){
                            alert('Masukkan nama Anda.');
                            return false;
                         }
                        // mengirimkan data ke berkas transaksi.input.php untuk di proses
			$.post(url, {nik: v_nik, nama: v_nama, tanggalmulai: v_tanggalmulai, id: idpengajuan, lamacuti: v_lamacuti,alasancuti: v_alasancuti} ,function() {
//$("#myModalLabel").html("Tambah Data approval");
 $('.statusMsg').html('<span style="color:green;">Sukses!</p>');
   $('#nik').val('');
   $('#nama').val('');
   $('#divisi').val('');
   $('#sisacuti').val('');
   
			});

		});
                
              $('.pagenya').live("click", function(){
                var nik = 0;
                var page = 0;
                var url = "approval.data.php"
                //pagenya = this.pagenya
                pagenya = this.id;
		//var main = "approval.data.php";
		var main = "approval.data.php?pagination=true&page=" + pagenya;
		// tampilkan data mahasiswa dari berkas mahasiswa.data.php 
		// ke dalam <div id="data-mahasiswa"></div>
		$("#data-approval").load(main);
		});  
		
		$("#btn-search").click(function(){ // Ketika tombol simpan di klik
		// Ubah text tombol search menjadi SEARCHING... 
		// Dan tambahkan atribut disable pada tombol nya agar tidak bisa diklik lagi
		$(this).html("SEARCHING coba...").attr("disabled", "disabled");
		
		$.ajax({
			url: 'search.php', // File tujuan
			type: 'POST', // Tentukan type nya POST atau GET
			data: {keyword: $("#keyword").val()}, // Set data yang akan dikirim
			dataType: "json",
			beforeSend: function(e) {
				if(e && e.overrideMimeType) {
					e.overrideMimeType("application/json;charset=UTF-8");
				}
			},
			success: function(response){ // Ketika proses pengiriman berhasil
				// Ubah kembali text button search menjadi SEARCH
				// Dan hapus atribut disabled untuk meng-enable kembali button search nya
				$("#btn-search").html("SEARCH").removeAttr("disabled");
				
				// Ganti isi dari div view dengan view yang diambil dari search.php
				$("#view").html(response.hasil);
			},
			error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
				alert(xhr.responseText); // munculkan alert
			}
		});
	});
	});
}) (jQuery);
