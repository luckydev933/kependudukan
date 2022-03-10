<?php 
    include "../../_connection.php";
    if(isset($_GET['module'])){
        $module = $_GET['module'];

        switch($module){
            case "kependudukan":
                $nik = $_GET['nik'];
                $query = mysqli_query($connect, "SELECT * FROM master_kependudukan WHERE nik='$nik'") or die(mysqli_error($connect));
                $data  = mysqli_fetch_assoc($query);
                
                echo json_encode($data);
            break;
            case "pernikahan":
                $nik = $_GET['nik'];
                $query = mysqli_query($connect, "SELECT * FROM data_pernikahan WHERE nik='$nik'") or die(mysqli_error($connect));
                $data  = mysqli_fetch_assoc($query);
                
                echo json_encode($data);
            break;    
            case "keluarga":
                $nik = $_GET['nik'];
                $query = mysqli_query($connect, "SELECT * FROM data_keluarga WHERE nik='$nik'") or die(mysqli_error($connect));
                $data  = mysqli_fetch_assoc($query);
                
                echo json_encode($data);  
            break;
            case "kelahiran":
                $kode_kelahiran = $_GET['kode_kelahiran'];
                $query = mysqli_query($connect, "SELECT * FROM data_kelahiran WHERE kd_kelahiran='$kode_kelahiran'") or die(mysqli_error($connect));
                $data  = mysqli_fetch_assoc($query);
                
                echo json_encode($data);  
            break;
        }
    }
?>