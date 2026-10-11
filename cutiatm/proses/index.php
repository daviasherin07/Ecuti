<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);
ini_set('display_errors','0');   if (session_status() === PHP_SESSION_NONE) { session_start(); }
ob_start();
?>
<!DOCTYPE html>
<html>
 <?php 
 include '../function/functionnya.php';
 
if(empty($_SESSION['username'])) {
   
    header("Location: ../index.php");

   }
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  session_destroy();
  $logoutGoTo = "../index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}

 ?>   
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Sistem Cuti Online KBRI Manila Filipina</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css">
        <link href="../css/menu.css" rel="stylesheet" type="text/css">
        <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
		
		<link href="../css/sweetalert.css" rel="stylesheet" type="text/css">
            <link href="../css/office.css" rel="stylesheet" type="text/css">
    
<link href="../css/theme-cream.css?v=20260626" rel="stylesheet" type="text/css">
</head>
    <body>
	
<script type="text/javascript">
swal("test");
</script>
        <div id="wrapper">
            <div id="header">
               Sistem Cuti Online <br />
               <br />
                KBRI Manila Filipina<br />
			   <br />			   <?php
			   echo "Hai, selamat datang ". $_SESSION['username'];  ?><a href="<?php echo $logoutAction ?>" class="btn btn-warning">Log Out</a>   

		   
		   </div>
			
             <div id="main-wrapper">
                    <div id="sidebar-wrapper">
					<!-- Begin of #login-details -->
		<section id="login-details">
    		<img class="img-left framed" src="../img/avatar_small.png" alt="Hello Admin">
    		<span style="color:white;">Login as </span>
    		<h2><a class="user-button" ><?php echo $_SESSION['username']; ?>&nbsp;</a></h2>
    		
    		
    		<div class="clearfix"></div>
  		</section> <!--! end of #login-details -->
                     <?php menunya() ?>
                    </div>
             </div> 
                       <div id="content-wrapper">
                         
                        <?php /* if(isset($_POST['txtpencarian'])){ 
						
						echo '<div id="caridata-proses"></div>';
						
						}else{
						echo '<div id="data-proses"></div>';
						}
						*/
						?>
                          
	<!--					
						
<div class="gruptest">		
						
						<span class="input-group-btn">
						<input type="text" class="form-control" placeholder="Pencarian..." id="keyword">
							<!-- Buat sebuah tombol search dan beri id btn-search -->
	<!--							<button class="btn btn-primary" type="button" id="btn-search" >SEARCH</button>
							<a href="" class="btn btn-warning">REFRESH</a>
						</span>
				
				
		
		 
	</div>	
<!-- awal untuk modal dialog -->
<div class="gruptest">	
<span class="input-group-btn">
                                               <a href="cetak.php">Cetak Data</a><br><br>
            </span>    
    
    </div>	
<div id="dialog-proses" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Tambah Data Proses</h3>
	</div>
	<!-- tempat untuk menampilkan form mahasiswa  -->
	<div class="modal-body"></div>
	<div class="modal-footer">
		
		<button id="simpan-proses" class="btn btn-success">Proses Cuti</button>
	</div>
 </div>
<div id="view"><div id="data-proses"></div></div> 
                
                  </div>
                
        </div>
       
        <?php
        // put your code here
        
        ?>
<script src="../js/jquery.min.js"></script>
<script src="../js/jquery-1.8.3.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/sweetalert-dev.js"></script>

<script src="aplikasi.js"></script>
    </body>
    <script type="text/javascript">
    $(function() {
   
        var menu_ul = $('.menu > li > ul'),
               menu_a  = $('.menu > li > a');
       
        menu_ul.hide();
   
        menu_a.click(function(e) {
            e.preventDefault();
            if(!$(this).hasClass('active')) {
                menu_a.removeClass('active');
                menu_ul.filter(':visible').slideUp('normal');
                $(this).addClass('active').next().stop(true,true).slideDown('normal');
            } else {
                $(this).removeClass('active');
                $(this).next().stop(true,true).slideUp('normal');
            }
        });
   
    });
</script>
</html>
<?php ob_flush(); ?>