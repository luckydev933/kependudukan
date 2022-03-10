<?php 
    $no = 0;
    include("_connection.php");
    $data = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(*) AS no_urut FROM data_kelahiran"));
    if($data["no_urut"] == 0){
        $no = 1;
    }else{
        $no = $data["no_urut"] + 1;
    }
    $kode_kelahiran = "KL-".date("Y-m-d")."-".$no."";
?>
<p class="content-title">Data Kelahiran</p>
<div class="row">
<div class="col-md-6 page">
    <form method="post" enctype="multipart/form-data" class="form">
        <label class="form-label">Kode Kelahiran</label>
        <input id="kode_kelahiran" value="<?php echo $kode_kelahiran ?>" readonly name="kode_kelahiran" type="text"><br>
        <div class="row">
            <div class="col-md-6">
                <label class="form-label">Nik Ayah</label>   
                <select id="nik_ayah" name="nik_ayah">
                    <option>pilih..</option>
                    <?php
                    include("_connection.php");
                    $query = mysqli_query($connect, "SELECT nik,nama FROM master_kependudukan WHERE jenis_kelamin='L' ORDER BY id DESC");
                    while($data = mysqli_fetch_assoc($query)){
                        ?>
                            <option value="<?php echo $data['nik'] ?>"><?php echo $data['nik'] ?> | <?php echo $data['nama'] ?></option>
                        <?php
                    } 
                    ?>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nik Ibu</label>   
                <select id="nik_ibu" name="nik_ibu">
                    <option>pilih..</option>
                    <?php
                    include("_connection.php");
                    $query = mysqli_query($connect, "SELECT nik,nama FROM master_kependudukan WHERE jenis_kelamin='P' ORDER BY id DESC");
                    while($data = mysqli_fetch_assoc($query)){
                        ?>
                            <option value="<?php echo $data['nik'] ?>"><?php echo $data['nik'] ?> | <?php echo $data['nama'] ?></option>
                        <?php
                    } 
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label class="form-label">Tanggal Lahir</label>
                <input id="tgl_lahir" name="tgl_lahir" type="date">
            </div>
            <div class="col-md-6">
                <label class="form-label">Berat Lahir (Kg)</label>
                <input id="berat_lahir" name="berat_lahir" type="number" step=".1">
            </div>
        </div>
        <label class="form-label">Jenis Kelamin</label>
        <select id="jenis_kelamin" name="jenis_kelamin">
            <option>pilih..</option>
            <option value="L">L</option>
            <option value="P">P</option>
        </select><br>
        <label class="form-label">Lampiran Surat/Keterangan Lahir</label>
        <input id="lampiran_lahir" name="lampiran_lahir" type="file"><br>
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
                <th>Kode Kelahiran</th>
                <th>Tanggal Lahir</th>
                <th>Berat Lahir</th>
                <th>Ayah</th>
                <th>Ibu</th>
                <th>Jenis Kelamin</th>
                <th>Lampiran</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            include("_connection.php");
            $query = mysqli_query($connect, "SELECT * FROM data_kelahiran
            ") or die(mysqli_error($connect));
            $no = 1;
              while($data = mysqli_fetch_assoc($query)){
                  ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><input onclick="EditData('<?php echo $data['kd_kelahiran'] ?>')" type="button" value="Edit"></td>
                    <td><a href= "process/kependudukan/hapus.php?kd_kelahiran=<?php echo $data['kd_kelahiran'] ?>&module=kelahiran" type="button">Delete</a></td>
                    <td><?php echo $data["kd_kelahiran"] ?></td>
                    <td><?php echo $data["tanggal_lahir"] ?></td>
                    <td><?php echo $data["berat_lahir"] ?></td>
                    <td><?php echo $data["nik_ayah"] ?></td>
                    <td><?php echo $data["nik_ibu"] ?></td>
                    <td><?php echo $data["jenis_kelamin"] == "L" ? "Laki-laki" : "Perempuan" ?></td>
                    <td><button class="btn btn-sm btn-success" onclick="setPictures('<?php echo $data['lampiran_surat_lahir'] ?>')" id="view-lampiran">Buka</td>
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
        $kode_kelahiran = $_POST['kode_kelahiran'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $berat_lahir = $_POST['berat_lahir'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $nik_ayah = $_POST['nik_ayah'];
        $nik_ibu = $_POST['nik_ibu'];
        $lampiran_lahir = $_FILES['lampiran_lahir']['name'];

        // ambil data file
        $namaSementara = $_FILES['lampiran_lahir']['tmp_name'];

        // tentukan lokasi file akan dipindahkan
        $dirUpload = "uploads/lampiran/";

        // pindahkan file
        $terupload = move_uploaded_file($namaSementara, $dirUpload.$lampiran_lahir);

        $query = "INSERT INTO data_kelahiran(kd_kelahiran, tanggal_lahir , berat_lahir, nik_ayah, nik_ibu, jenis_kelamin, lampiran_surat_lahir)
        VALUES('$kode_kelahiran', '$tgl_lahir', '$berat_lahir', '$nik_ayah','$nik_ibu', '$jenis_kelamin','$lampiran_lahir')";

        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
    }
    if(isset($_POST['edit'])){
        $kode_kelahiran = $_POST['kode_kelahiran'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $berat_lahir = $_POST['berat_lahir'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $nik_ayah = $_POST['nik_ayah'];
        $nik_ibu = $_POST['nik_ibu'];
        $lampiran_lahir = $_FILES['lampiran_lahir']['name'];

        // ambil data file
        $namaSementara = $_FILES['lampiran_lahir']['tmp_name'];

        // tentukan lokasi file akan dipindahkan
        $dirUpload = "uploads/lampiran/";

        // pindahkan file
        $terupload = move_uploaded_file($namaSementara, $dirUpload.$lampiran_lahir);

        $query = "UPDATE data_kelahiran SET 
                  tanggal_lahir='$tgl_lahir',
                  berat_lahir='$berat_lahir',
                  jenis_kelamin='$jenis_kelamin',
                  nik_ibu='$nik_ibu',
                  nik_ayah='$nik_ayah',
                  lampiran_surat_lahir='$lampiran_lahir'
                  WHERE kd_kelahiran='$kode_kelahiran'";

        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
    }
?>

<script type="text/javascript">
    function setPictures(value){
        console.log(value)
        document.getElementById("view-picture").innerHTML = `<img width='500' height='300' src='uploads/lampiran/${value}' />`
    }
    function EditData(value){
        $.get("process/kependudukan/editdata.php?kode_kelahiran="+value+"&module=kelahiran", (data, status) => {
            document.getElementById("edit_data").removeAttribute("hidden")
            let object = JSON.parse(data)
            console.log(object)
            document.getElementById("kode_kelahiran").focus()
            document.getElementById("kode_kelahiran").setAttribute("readonly", true)
            document.getElementById("kode_kelahiran").value = object.kd_kelahiran
            document.getElementById("nik_ayah").value = object.nik_ayah
            document.getElementById("nik_ibu").value = object.nik_ibu
            document.getElementById("berat_lahir").value = object.berat_lahir
            document.getElementById("tgl_lahir").value = object.tanggal_lahir
            document.getElementById("lampiran_lahir").value = object.lampiran_surat_lahir
            document.getElementById("jenis_kelamin").value = object.jenis_kelamin
            document.getElementById("simpan_data").disabled = true
        })
    }
</script>