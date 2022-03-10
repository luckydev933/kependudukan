<p class="content-title">Data Keluarga</p>
<div class="row">
<div class="col-md-6 page">
    <form method="post" enctype="multipart/form-data" class="form">
        <label class="form-label">Nik</label>   
        <select id="nik" name="nik">
            <option>pilih..</option>
            <?php
            include("_connection.php");
              $query = mysqli_query($connect, "SELECT nik,nama FROM master_kependudukan ORDER BY id DESC");
              while($data = mysqli_fetch_assoc($query)){
                  ?>
                    <option value="<?php echo $data['nik'] ?>"><?php echo $data['nik'] ?> | <?php echo $data['nama'] ?></option>
                  <?php
              } 
            ?>
        </select><br>
        <?php 
            $no = 0;
            include("_connection.php");
            $data = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(*) AS no_urut FROM data_pernikahan"));
            if($data["no_urut"] == 0){
                $no = 1;
            }else{
                $no = $data["no_urut"] + 1;
            }
            $kode_pernikahan = "PR-".date("Y/m/d")."-".$no."";
        ?>
        <label class="form-label">No KK</label>
        <input id="no_kk" name="no_kk" type="text"><br>
        <label class="form-label">Lampiran KK</label>
        <input id="lampiran_kk" name="lampiran_kk" type="file"><br>
        <input id="simpan_data" type="submit" name="submit" value="Simpan Data" >
        <input hidden id="edit_data" type="submit" name="edit" value="Simpan Perubahan" >
    </form>
</div>
<div class="col-md-5 page" style="margin-left:5px;">
    <p class="content-title">Lampiran View</p>
    <div id="view-picture"></div>
</div>
</div>

<br>
<div class="col-md-12 page">
    <table id="table-penduduk" class="display">
        <thead>
            <tr>
                <th>No</th>
                <th></th>
                <th></th>
                <th>Nik</th>
                <th>No KK</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Pekerjaan</th>
                <th>Jenis Kelamin</th>
                <th>Lampiran</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            include("_connection.php");
            $query = mysqli_query($connect, "SELECT dk.nik, mk.nama, mk.alamat_domisili, 
            mk.jenis_kelamin, mp.nama_pekerjaan, dk.kd_keluarga, dk.lampiran_kk
            FROM data_keluarga dk
            LEFT JOIN master_kependudukan mk on mk.nik = dk.nik
            LEFT JOIN master_pekerjaan mp on mp.kd_pekerjaan = mk.kd_pekerjaan
            ") or die(mysqli_error($connect));
            $no = 1;
              while($data = mysqli_fetch_assoc($query)){
                  ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><input onclick="EditData('<?php echo $data['nik'] ?>')" type="button" value="Edit"></td>
                    <td><a href= "process/kependudukan/hapus.php?nik=<?php echo $data['nik'] ?>&module=keluarga" type="button">Delete</a></td>
                    <td><?php echo $data["nik"] ?></td>
                    <td><?php echo $data["kd_keluarga"] ?></td>
                    <td><?php echo $data["nama"] ?></td>
                    <td><?php echo $data["alamat_domisili"] ?></td>
                    <td><?php echo $data["nama_pekerjaan"] ?></td>
                    <td><?php echo $data["jenis_kelamin"] == "L" ? "Laki-laki" : "Perempuan" ?></td>
                    <td><button class="btn btn-sm btn-success" onclick="setPictures('<?php echo $data['lampiran_kk'] ?>')" id="view-lampiran">Buka</td>
              </tr>
                  <?php
              } 
            ?>
        </tbody>
    </table>
</div>
<?php
    include("_connection.php");
    if(isset($_POST['submit'])){
        $nik = $_POST['nik'];
        $no_kk = $_POST['no_kk'];
        $lampiran_kk = $_FILES['lampiran_kk']['name'];

        // ambil data file
        $namaSementara = $_FILES['lampiran_kk']['tmp_name'];

        // tentukan lokasi file akan dipindahkan
        $dirUpload = "uploads/lampiran/";

        // pindahkan file
        $terupload = move_uploaded_file($namaSementara, $dirUpload.$lampiran_kk);

        $query = "INSERT INTO data_keluarga(nik, kd_keluarga ,lampiran_kk)
        VALUES('$nik', '$no_kk', '$lampiran_kk')";

        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
    }
    if(isset($_POST['edit'])){
        $nik = $_POST['nik'];
        $no_kk = $_POST['no_kk'];
        $lampiran_kk = $_FILES['lampiran_kk']['name'];

        // ambil data file
        $namaSementara = $_FILES['lampiran_kk']['tmp_name'];

        // tentukan lokasi file akan dipindahkan
        $dirUpload = "uploads/lampiran/";

        // pindahkan file
        $terupload = move_uploaded_file($namaSementara, $dirUpload.$lampiran_kk);

        $query = "UPDATE data_keluarga SET kd_keluarga='$no_kk', 
                  lampiran_kk='$lampiran_kk' WHERE nik='$nik'";

        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
    }
?>

<script type="text/javascript">
    function setPictures(value){
        console.log(value)
        document.getElementById("view-picture").innerHTML = `<img width='500' height='300' src='uploads/lampiran/${value}' />`
    }
    function EditData(value){
        $.get("process/kependudukan/editdata.php?nik="+value+"&module=keluarga", (data, status) => {
            document.getElementById("edit_data").removeAttribute("hidden")
            let object = JSON.parse(data)
            console.log(object)
            document.getElementById("nik").focus()
            document.getElementById("nik").setAttribute("readonly", true)
            document.getElementById("nik").value = object.nik
            document.getElementById("no_kk").value = object.kd_keluarga
            document.getElementById("lampiran_kk").value = object.lampiran_kk
            document.getElementById("simpan_data").disabled = true
        })
    }
</script>