<?php 
    include('../../_connection.php');
    if(isset($_GET['module'])){
        $module = $_GET['module'];
        switch($module){
            case "kependudukan":
                if(isset($_GET["nik"])){
                    $nik = $_GET["nik"];
                    $result = mysqli_query($connect, "DELETE FROM master_kependudukan WHERE nik='$nik'");
                    if($result){
                        ?>
                            <script>
                                window.location.href="../../index.php?page=kependudukan"
                            </script>
                        <?php
                    }
                }
            break; 
            
            case "pernikahan":
                if(isset($_GET["nik"])){
                    $nik = $_GET["nik"];
                    $result = mysqli_query($connect, "DELETE FROM data_pernikahan WHERE nik='$nik'");
                    if($result){
                        ?>
                            <script>
                                window.location.href="../../index.php?page=pernikahan"
                            </script>
                        <?php
                    }
                }
            break;

            case "keluarga":
                if(isset($_GET["nik"])){
                    $nik = $_GET["nik"];
                    $result = mysqli_query($connect, "DELETE FROM data_keluarga WHERE nik='$nik'");
                    if($result){
                        ?>
                            <script>
                                window.location.href="../../index.php?page=keluarga"
                            </script>
                        <?php
                    }
                }
            break;

            case "kelahiran":
                if(isset($_GET["kode_kelahiran"])){
                    $kode = $_GET["kode_kelahiran"];
                    $result = mysqli_query($connect, "DELETE FROM data_kelahiran WHERE kode_kelahiran='$kode'");
                    if($result){
                        ?>
                            <script>
                                window.location.href="../../index.php?page=kelahiran"
                            </script>
                        <?php
                    }
                }
            break;
            
            default:
                ?>
                    <script>
                        window.location.href="../../index.php"
                    </script>
                <?php
                
        }
    }
?>