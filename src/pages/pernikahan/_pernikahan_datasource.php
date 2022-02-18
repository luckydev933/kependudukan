<?php
    include("../../../_connection.php");
    $source = array(
        "nik_source" => mysqli_fetch_array( mysqli_query($connect, "SELECT NIK FROM master_kependudukan ORDER BY id"))
    );
    var_dump($source);
?>