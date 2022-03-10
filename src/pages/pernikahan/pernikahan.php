<p class="content-title">Data Pernikahan</p>
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
        <label class="form-label">Tanggal Pernikahan</label>
        <input id="tanggal_pernikahan" name ="tanggal_pernikahan" type="date">
        <label class="form-label">Status Di Keluarga</label>
        <select id="status_keluarga" name="status">
            <option>pilih..</option>
            <option value="S">Suami</option>
            <option value="I">Isteri</option>
        </select><br>
        <label class="form-label">No Akta Nikah</label>
        <input id="no_akta_nikah" name="no_akta_nikah" type="text"><br>
        <label class="form-label">Lampiran Keterangan Menikah</label>
        <input id="lampiran_buku_nikah" name="lampiran_buku_nikah" type="file"><br>
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
                <th>Nama</th>
                <th>Tanggal Pernikahan</th>
                <th>No Akta</th>
                <th>Alamat</th>
                <th>Pekerjaan</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>Pendidikan</th>
                <th>Status di Keluarga</th>
                <th>Lampiran</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            include("_connection.php");
            $query = mysqli_query($connect, "SELECT * FROM data_pernikahan AS dp
            LEFT JOIN master_kependudukan AS mk on mk.nik = dp.nik
            LEFT JOIN master_pekerjaan AS mpk on mpk.kd_pekerjaan = mk.kd_pekerjaan
            LEFT JOIN master_pendidikan AS mpd on mpd.kd_pendidikan = mk.kd_pendidikan 
            ") or die(mysqli_error($connect));
            $no = 1;
              while($data = mysqli_fetch_assoc($query)){
                  ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><input onclick="EditData('<?php echo $data['nik'] ?>')" type="button" value="Edit"></td>
                    <td><a href= "process/kependudukan/hapus.php?nik=<?php echo $data['nik'] ?>&module=pernikahan" type="button">Delete</a></td>
                    <td><?php echo $data["nik"] ?></td>
                    <td><?php echo $data["nama"] ?></td>
                    <td><?php echo $data["tanggal_pernikahan"] ?></td>
                    <td><?php echo $data["no_akta_nikah"] ?></td>
                    <td><?php echo $data["alamat_domisili"] ?></td>
                    <td><?php echo $data["nama_pekerjaan"] ?></td>
                    <td><?php echo $data["jenis_kelamin"] == "L" ? "Laki-laki" : "Perempuan" ?></td>
                    <td><?php echo $data["agama"] ?></td>
                    <td><?php echo $data["nama_pendidikan"] ?></td>
                    <td><?php echo $data["status_keluarga"] == "S" ? "SUAMI" : "ISTERI"?></td>
                    <td><button class="btn btn-sm btn-success" onclick="setPictures('<?php echo $data['lampiran_buku_nikah'] ?>')" id="view-lampiran">Buka</td>
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
        $tanggal_pernikahan = $_POST['tanggal_pernikahan'];
        $status = $_POST['status'];
        $no_akta_nikah = $_POST['no_akta_nikah'];
        $lampiran_buku_nikah = $_FILES['lampiran_buku_nikah']['name'];

        // ambil data file
        $namaSementara = $_FILES['lampiran_buku_nikah']['tmp_name'];

        // tentukan lokasi file akan dipindahkan
        $dirUpload = "uploads/lampiran/";

        // pindahkan file
        $terupload = move_uploaded_file($namaSementara, $dirUpload.$lampiran_buku_nikah);

        $query = "INSERT INTO data_pernikahan(nik, tanggal_pernikahan, no_akta_nikah, status_keluarga ,lampiran_buku_nikah)
        VALUES('$nik', '$tanggal_pernikahan', '$no_akta_nikah', '$status', '$lampiran_buku_nikah')";

        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
    }
    if(isset($_POST['edit'])){
        $nik = $_POST['nik'];
        $tanggal_pernikahan = $_POST['tanggal_pernikahan'];
        $status = $_POST['status'];
        $no_akta_nikah = $_POST['no_akta_nikah'];
        $lampiran_buku_nikah = $_FILES['lampiran_buku_nikah']['name'];

        // ambil data file
        $namaSementara = $_FILES['lampiran_buku_nikah']['tmp_name'];

        // tentukan lokasi file akan dipindahkan
        $dirUpload = "uploads/lampiran/";

        // pindahkan file
        $terupload = move_uploaded_file($namaSementara, $dirUpload.$lampiran_buku_nikah);

        $query = "UPDATE data_pernikahan SET tanggal_pernikahan='$tanggal_pernikahan', 
                  no_akta_nikah='$no_akta_nikah', status_keluarga='$status' ,
                  lampiran_buku_nikah='$lampiran_buku_nikah' WHERE nik='$nik'";

        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
    }
?>

<script type="text/javascript">
    function setPictures(value){
        console.log(value)
        document.getElementById("view-picture").innerHTML = `<img width='500' height='300' src='uploads/lampiran/${value}' />`
    }
    function EditData(value){
        $.get("process/kependudukan/editdata.php?nik="+value+"&module=pernikahan", (data, status) => {
            document.getElementById("edit_data").removeAttribute("hidden")
            let object = JSON.parse(data)
            document.getElementById("nik").focus()
            document.getElementById("nik").setAttribute("readonly", true)
            document.getElementById("nik").value = object.nik
            document.getElementById("tanggal_pernikahan").value = object.tanggal_pernikahan
            document.getElementById("no_akta_nikah").value = object.no_akta_nikah
            document.getElementById("status_keluarga").value = object.status_keluarga
            document.getElementById("lampiran_buku_nikah").value = object.lampiran_buku_nikah
            document.getElementById("simpan_data").disabled = true
        })
    }
</script>