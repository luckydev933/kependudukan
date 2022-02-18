<?php 
    $form = array(
        "kode_pernikahan" => $_POST["kode_pernikahan"],
        "tanggal_pernikahan" => $_POST["tanggal_pernikahan"],
        "status" => $_POST["status"],
        "lampiran_buku_nikah" => $_POST["lampiran_buku_nikah"]
    );
    $result = mysqli_query("INSERT INTO data_pernikahan ")
?>