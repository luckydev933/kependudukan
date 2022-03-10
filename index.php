<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
    }
    require('_constant.php');
    require('_function.php');
    include("_connection.php");
    $query = mysqli_query($connect, "SELECT * FROM master_pekerjaan");
?>

<!DOCTYPE html>
<html class="menu">
   <html>
      <head>
         <meta charset="utf-8"/>
         <meta http-equiv="X-UA-Compatible" content=="IE=edge"/>
         <meta name="google" value="notranslate"/>
         <title>Side Menu</title>
         <link rel="stylesheet" type="text/css" href="style.css">
         <!-- CSS only -->
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
         <!-- JavaScript Bundle with Popper -->
         <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
         <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
         <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
         <script src="http://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
         <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
         <script src="https://www.gstatic.com/charts/loader.js"></script>
      </head>
      <body>
         </div>
         <nav class="main-menu">
            <div>
               <a class="logo" href="index.php?page=admin">
                   <center><img src="images/logo-tala.png" width="80%" style="padding: 5px;"/></center>
               </a> 
            </div>
            <div class="settings"></div>
            <div class="scrollbar" id="style-1">
            <ul>
               <li>                                   
                  <a href="index.php?page=admin">
                  <i class="fa fa-home fa-lg"></i>
                  <span class="nav-text">Home</span>
                  </a>
               </li>
               </li>
               <li class="darkerlishadow">
                  <a href="index.php?page=kependudukan">
                  <i class="fa fa-archive fa-lg"></i>
                  <span class="nav-text">Master Kependudukan</span>
                  </a>
               </li>
               <li class="darkerli">
                <a href="index.php?page=keluarga">
                <i class="fa fa-book fa-lg"></i>
                <span class="nav-text">Data Keluarga</span>
                </a>
             </li>
               <li class="darkerli">
                  <a href="index.php?page=pernikahan">
                  <i class="fa fa-book fa-lg"></i>
                  <span class="nav-text">Data Pernikahan</span>
                  </a>
               </li>
               <li class="darkerli">
                  <a href="index.php?page=kelahiran">
                  <i class="fa fa-book fa-lg"></i>
                  <span class="nav-text">Data Kelahiran</span>
                  </a>
               </li>
               <li class="darkerli">
                  <a href="index.php?page=rekap">
                  <i class="fa fa-book fa-lg"></i>
                  <span class="nav-text">Rekap Data</span>
                  </a>
               </li>
               
            </ul>
            <li>
               <a href="logout-action.php">
               <i class="fa fa-power-off fa-lg"></i>
               <span class="nav-text">Logout</span>
               </a>
            </li>
         </nav>
         <div class="content-wrapper">
             <div class="container">
                 <center><p>Sistem Informasi Kependudukan Desa Tajau Pecah</p></center>
             </div>
         </div>
         <div class="container">
            <div class="content-page">
                <?php
                  if(isset($_GET["page"])){
                     getPage($_GET["page"]);
                  }
                ?>
            </div>
         </div>
       <script type="text/javascript">
         $(document).ready( function () {
            $('#table-penduduk').DataTable();
            $(function() {
               $("#nik_search_pernikahan").autocomplete({
                  source: "search.php",
               });
            });
         });
     </script>
      </body>
   </html>