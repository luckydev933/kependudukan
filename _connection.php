<?php
    $host       = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "kependudukan";

    $connect = mysqli_connect($host, $username, $password, $dbname);

    if(!$connect){
        echo "Connection Error";
    }
?>